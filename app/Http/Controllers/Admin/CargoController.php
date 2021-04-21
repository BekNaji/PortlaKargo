<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\CargoStatus;
use App\Models\CargoLog;
use App\Models\Product;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Receiver;
use Auth;
use App;
use App\User;
use Illuminate\Support\Carbon;
use Excel;
use Illuminate\Support\Facades\Http;
use App\Helpers\SendSMS;
use App\Helpers\SendSMSUz;
use Permission;
use Cache;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{

    public function __construct(Request $request)
    {

        $this->middleware(function ($request, $next)
        {
            if(Auth::user()->company->cargo_letter == '')
            {
                return redirect()
                ->route('settings.index')
                ->with(['message'=>'Lütfen Önce Kargo numara ilk harfını Belirleyiniz!']);
            }


            return $next($request);
        });
    }
  
    
    public function index(Request $request)
    {

        // if user role is admin
    	if(Auth::user()->role == 'admin')
        {
            $cargos  = Cargo::where('company_id',Auth::user()->company_id)
            ->orderBy('id','DESC');
        }
        // if user role equal to user. Role User only can see own datas
        if(Auth::user()->role == 'user')
        {
            $cargos  = Cargo::where('company_id',Auth::user()->company_id)
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('id','DESC');
        }
        $cargos = $cargos->where('public_status','=',1)->with('user')->with('sender')->with('receiver')->with('cargoStatus')->paginate(10);
        
        $users = User::where('company_id','=',Auth::user()->company_id)->get();

        $statuses = CargoStatus::where('company_id','=',Auth::user()->company_id)->get();
        $paginate = true;
    	return view('admin.cargo.index',compact('cargos','statuses','users','paginate'));
    }
    
    // create cargo page
    public function create()
    {
        // if user has not permission create cargo
        if(!Permission::check('cargo-create'))
        {
            abort('419');
        }
        // get statuses for use cargo crate page
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        return view('admin.cargo.create',compact('statuses'));
    }

    # show cargo info
    public function show(Request $request)
    {
        // if user has not permission show cargo return 419 error
        if(!Permission::check('cargo-show'))
        {
            abort('419');
        }
        // get cargo data according to request id
        $cargo = Cargo::find(decrypt($request->id));

        // get status datas for use show cargo page
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();

        // get product datas according cargo id
        $products = Product::where('cargo_id',$cargo->id)->get();

        return view('admin.cargo.show',
               compact('cargo','products','statuses'));
    }

    # delete cargo
    public function delete(Request $request)
    {
        // if has not permission delete of user return 419
        if(!Permission::check('cargo-delete'))
        {
            abort('419');
        }

        // get data according to id and delete then return back success message
        $cargo = Cargo::find($request->id);
        $cargo->delete();
        return back()->with(['success'=>'Silindi!']);
    }

    # make filter
    public function filter(Request $request)
    {
        $cargos = Cargo::where('company_id',Auth::user()->company_id);
        $req = $request;
        $users = User::where('company_id','=',Auth::user()->company_id)->get();
        $data = [];
        $data['cargos'] =[];
        if($request->start !='')
        {
            $from = Carbon::parse($request->start.' 00:00:00')->format('Y-m-d H:i:s');
            $cargos->where('created_at','>=',$from)->get();;
        }

        if($request->end !='')
        {
            $to   = Carbon::parse($request->end.' 23:59:59')->format('Y-m-d H:i:s');
            $cargos->where('created_at','<=',$to)->get();
        }

        if($request->status != 'all')
        {
            $cargos->where('status','=',$request->status)->get();;
        }

        if($request->user != 'all')
        {
            $cargos->where('user_id','=',$request->user)->get();
        }
        $cargos = $cargos->orderBy('id','DESC')->with('user')->with('receiver')->with('sender')->with('cargoStatus')->get();
        $users = User::where('company_id','=',Auth::user()->company_id)->get();
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        $paginate = false;
        return view('admin.cargo.index',compact('cargos','statuses','users','paginate'));
    }

    # change status
    public function changeStatus(Request $request)
    {
        if(!Permission::check('cargo-status-change'))
        {
            abort('419');
        }
        $ids = explode(',', $request->ids);


        foreach ($ids as $key => $id)
        {
            $cargo = Cargo::find($id);
            $status = CargoStatus::find($request->status);
            $cargo->public_status = $status->public_status;
            if($cargo->status != $request->status)
            {
                $this->storeLog($cargo->id,$request->status);

            }
            $cargo->status = $request->status;
            $cargo->save();

        }



        return back()->with(['success'=>'Güncellendi']);
    }

    # store log
    public function storeLog($id,$status)
    {

        $cargoLog = new CargoLog();
        $cargoLog->cargo_id = $id;
        $cargoLog->cargo_status_id = $status;
        $cargoLog->save();
        $status = CargoStatus::find($status);
        
        if($status->send_phone == 'true')
        {
            $this->sendPhone($id,$status->name);
            $this->sendPhoneUz($id,$status->name);
        }

    }

    # make barcode
    public function getBarcode($data)
    {
        //Generate into customize folder under public
        $bar = App::make('BarCode');
        $barcode = [
            'text' => $data,
            'size' => 40,
            'orientation' => 'horizontal',
            'code_type' => 'code128a',
            'print' => true,
            'sizefactor' => 2,
            'filename' => 'image1.jpeg',
            'filepath' => 'barcode'
        ];
        $barcontent = $bar->barcodeFactory()->renderBarcode(
        $text=$barcode["text"],
        $size=$barcode['size'],
        $orientation=$barcode['orientation'],
        $code_type=$barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar
        $print=$barcode['print'],
        $sizefactor=$barcode['sizefactor'],
        $filename = $barcode['filename'],
        $filepath = $barcode['filepath']
        )->filename($barcode['filename']);

        return $barcontent.'?barcode='.rand(1111,9999);

    }

    # store cargo
    public function storeAll(Request $request)
    {
        if(!Permission::check('cargo-create'))
        {
            abort('419');
        }
        $sender_id = $this->storeCustomer($request);

        $receiver_id = $this->storeReceiver($request);

        $company = Company::find(Auth::user()->company_id);
        $cargo_row = $company->cargo_row + 1;

        $company->cargo_row = $cargo_row;
        $company->save();



        $status = CargoStatus::find($request->status);
        $cargo = new Cargo();
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        // important !
        $cargo->public_status = $status->public_status;

        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        $cargo->user_id = Auth::user()->id;

        $cargo->number = Auth::user()
        ->company->cargo_letter.sprintf("%05s",$company->cargo_row);
        $cargo->save();
        $cargo_id = $cargo->id;


        $total_price = 0;

        $this->storeLog($cargo->id,$cargo->status);

        foreach ($request->product_name as $key=> $name)
        {
            if($name != '')
            {
                $product = new Product();
                $product->name = $request->product_name[$key];
                $product->count = $request->product_count[$key] ?? 0;
                $product->cost = $request->product_price[$key] ?? 0;
                $product->total = $request->product_total_price[$key] ?? 0;
                $product->cargo_id = $cargo_id;
                $product->save();

                $total_price += $request->product_total_price[$key];
            }
        }

        $cargo = Cargo::find($cargo_id);
        $cargo->total_price = $total_price;
        $cargo->save();



        return redirect()
        ->route('cargo.show',encrypt($cargo->id))
        ->with(['success'=>'Kaydedildi!']);
    }

    # update cargo
    public function updateAll(Request $request)
    {
        if(!Permission::check('cargo-create'))
        {
            abort('419');
        }
        $sender_id = $this->storeCustomer($request);

        $receiver_id = $this->storeReceiver($request);

        $cargo = Cargo::find($request->cargo_id);

        if($cargo->status != $request->status)
        {
            $this->storeLog($cargo->id,$request->status);

        }
        $status = CargoStatus::find($request->status);

        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->public_status = $status->public_status;

        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        $cargo->save();

        $cargo_id = $cargo->id;


        $total_price = '0';

        foreach ($request->product_name as $key=> $name)
        {

            if($request->product_id[$key] != '')
            {
                $product = Product::find($request->product_id[$key]);

                if($name != '')
                {
                    $product->name      = $request->product_name[$key];
                    $product->count     = $request->product_count[$key] ?? 0;
                    $product->cost      = $request->product_price[$key] ?? 0;
                    $product->total     = $request->product_total_price[$key] ?? 0;
                    $total_price       += $request->product_total_price[$key] ?? 0;
                    $product->cargo_id  = $cargo_id;
                    $product->save();
                }else
                {
                    $product->delete();
                }
            }else
            {
                if($name != '')
                {
                    $product = new Product();
                    $product->name = $request->product_name[$key];
                    $product->count = $request->product_count[$key];
                    $product->cost = $request->product_price[$key];
                    $product->total = $request->product_total_price[$key];
                    $total_price += $request->product_total_price[$key];
                    $product->cargo_id = $cargo_id;
                    $product->save();
                }
            }

        }
        $cargo = Cargo::find($cargo_id);
        $cargo->total_price = $total_price;
        $cargo->save();



        return redirect()
        ->route('cargo.show',encrypt($cargo->id))
        ->with(['success'=>'Güncellendi!']);
    }

    # print cargo
    public function print(Request $request)
    {

        $cargo = Cargo::find(decrypt($request->id));
        $barcode = $this->getBarcode($cargo->number);
        $products = Product::where('cargo_id',$cargo->id)->get();
        $company = Company::find(Auth::user()->company_id);
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();

        return view('admin.cargo.print',compact('cargo','products','barcode','company','statuses'));
    }

    # store and update Sender
    public function storeCustomer($request)
    {
        $sender = Customer::where('phone','=',$request->sender_phone)
        ->where('company_id','=',Auth::user()->company_id)
        ->get()->first();

        if(!$sender)
        {
            $sender = new Customer();
        }

        $sender->name = strtoupper($request->sender_name);
        $sender->phone = $request->sender_phone;
        $sender->company_id = Auth::user()->company_id;
        $sender->save();

        return $sender->id;

    }

    # store and update Receiver
    public function storeReceiver($request)
    {
        $receiver = Receiver::where('phone','=',$request->receiver_phone)
        ->where('company_id','=',Auth::user()->company_id)
        ->get()->first();
        if(!$receiver)
        {
            $receiver = new Receiver();
        }
        $receiver->name = strtoupper($request->receiver_name);
        $receiver->passport = strtoupper($request->receiver_passport);
        $receiver->phone = $request->receiver_phone;
        $receiver->other_phone = $request->receiver_other_phone;
        $receiver->address = strtoupper($request->receiver_address);
        $receiver->company_id = Auth::user()->company_id;
        $receiver->save();
        return  $receiver->id;
    }

    # make excel
    public function manafesExcel(Request $request)
    {
        if(!Permission::check('create-excel'))
        {
            abort('419');
        }
        $cargos = Cargo::where('company_id',Auth::user()->company_id)->orderBy('sender_id','ASC');

        if($request->start !='')
        {
            $from = Carbon::parse($request->start.' 00:00:00')->format('Y-m-d H:i:s');
            $cargos->where('created_at','>=',$from)->get();
        }
        if($request->end !='')
        {
            $to   = Carbon::parse($request->end.' 23:59:59')->format('Y-m-d H:i:s');
            $cargos->where('created_at','<=',$to)->get();

        }

        if($request->status != 'all')
        {
            $cargos->where('status','=',$request->status);
        }
        if($request->user != 'all')
        {
            $cargos->where('user_id','=',$request->user);
        }
        $cargos = $cargos->get();

        // make excell delivery
        if($request->type == 'delivery')
        {
            // header of  excell datas
            $datas = [
                [ 'Invoice No','Name','Address','KG','Cash','Phone','Other Phone','Sender'],
            ];

            foreach($cargos as $cargo)
            {
                $receiver = explode(' ',$cargo->receiver->name);
                if(count($receiver) > 1)
                {
                    $receiver = $receiver[1];
                }else{
                    $receiver = $receiver[0];
                }

                $address = explode(' ',$cargo->receiver->address);

                if(count($address) >= 2 )
                {
                    $address = $address[0].' '.$address[1];

                }else{

                    $address = $address[0];
                }

                $phone2 = $cargo->receiver->other_phone ?? '';

                $data = [
                    $cargo->number ?? '',
                    $receiver ?? '',
                    $address ?? '',
                    $cargo->total_kg ?? '',
                    $cargo->cargo_price ?? '0',
                    $cargo->receiver->phone ?? '',
                    $phone2,
                    $cargo->sender->phone ?? '',
                ];

                array_push($datas,$data);

            }

            // define name to excell file
            $date = date('d.m.Y');
            $filename = $date.'-dastafka.xlsx';
        }

        // make excell manafes
        if($request->type == 'manafes')
        {
            $datas = [
                    [ 'Invoice No','Name','Passport','Total KG','Total Price'],
                ];
            foreach ($cargos as $key => $value)
            {

                $data = [
                            $value->number ?? '',
                            $value->receiver->name ?? '',
                            $value->receiver->passport ?? '',
                            $value->total_kg ?? '',
                            $value->total_price,
                        ];

                array_push($datas, $data);

            }


            $date = date('d.m.Y');
            $filename = $date.'-manafes.xlsx';
        }

        // make excell baza
        if($request->type == 'baza')
        {

            $datas = [
                    ['Invoice No','Tarih','Sender','Sender Tel','Recevier','Receiver Tel:1','Receiver Tel:2','City','Town','Street','Total KG','Total Price','Passport','']
                ];
            $product_headers = ['Product Name','Total Count','Price','Total Price',''];
            for($i=1; $i<22; $i++)
            {
            array_push($datas[0], 'Product Name. '.$i);
            array_push($datas[0], 'Total Count. '.$i);
            array_push($datas[0], 'Price. '.$i);
            array_push($datas[0], 'Total Price. '.$i);
            array_push($datas[0],'');
            }

            foreach ($cargos as $key => $cargo)
            {
                $products = Product::where('cargo_id','=',$cargo->id)->get();

                $address = explode(' ', $cargo->receiver->address ?? '');

                $data = [
                        $cargo->number ?? '',
                        $cargo->created_at ?? '',
                        $cargo->sender->name ?? '',
                        $cargo->sender->phone ?? '',
                        $cargo->receiver->name ?? '',
                        $cargo->receiver->phone ?? '',
                        $cargo->receiver->other_phone ?? '',
                        $address[0] ?? '',
                        $address[1] ?? '',
                        $address[2] ?? '',
                        $cargo->total_kg ?? '',
                        $cargo->total_price ?? '',
                        $cargo->receiver->passport ?? '',
                        '',
                        ];


                foreach ($products as $key => $product)
                {
                    if($cargo->id == $product->cargo_id)
                    {

                        array_push($data, $product->name ?? '');
                        array_push($data, $product->count ?? '');
                        array_push($data, $product->cost ?? '');
                        array_push($data, $product->total ?? '');
                        array_push($data, '');

                    }
                }

                array_push($datas, $data);

            }
            $date = date('d.m.Y');
            $filename = $date.'-baza.xlsx';
            // dd($datas);
        }

        return Excel::download(new App\Exports\CargoExcel($datas), $filename);
    }

    public function search(Request $request)
    {
        $key = $request->key;
        if($key == ''){ return json_encode(['cargo'=>'']); }

        $cargos = Cargo::orWhereHas('sender',function($query) use ($key){
            $query->where('name','like','%'.$key.'%');
        })->orWhereHas('receiver',function($query) use ($key){
            $query->where('name','like','%'.$key.'%');
        })->orWhere('number','like','%'.$key.'%')->with('user')->with('sender')->with('receiver')->with('cargoStatus')->get();
        return json_encode(['cargo'=>$cargos]);
    }
    # send message to user with Mobile phone
    public function sendPhone($id,$status)
    {
        $message  = '';
        $cargo    = Cargo::find($id);
        $message .= 'Kargo KODİ: '.$cargo->number.PHP_EOL;
        $message .= 'Status: '.$status.PHP_EOL;
        $message .= 'Online Tekshirish uchun link '.PHP_EOL;
        $message .= 'https://portalkargo.com'.PHP_EOL;
        $message .= 'Operator tel: +908504411101'.PHP_EOL;

        $sms = new SendSMS();

        return $sms->sendSms($message,$cargo->sender->phone);

    }

    # send message to user with Mobile phone
    public function sendPhoneUz($id,$status)
    {
        $message  = '';
        $cargo    = Cargo::find($id);
        $message .= 'Kargo KODİ: '.$cargo->number.PHP_EOL;
        $message .= 'Status: '.$status.PHP_EOL;
        $message .= 'Online Tekshirish uchun link '.PHP_EOL;
        $message .= 'https://portalkargo.com'.PHP_EOL;
        $message .= 'Operator tel: +908504411101'.PHP_EOL;

        $sms = new SendSMS();
        $tel = $cargo->receiver->phone;
        if(strlen($tel) != 12)
        {
            $tel = '998'.str_replace([' ',',','  '],'',$cargo->receiver->phone);
        }

        return $sms->sendSmsUz($message,$tel);

    }


}
