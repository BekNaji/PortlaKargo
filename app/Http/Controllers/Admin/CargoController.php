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
use View;
use Response;
use App\Models\City;

class CargoController extends Controller
{
  
    /*
    * List of cargos
    * @param $request array
    * @return response
    */
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
        $cargos = $cargos->where('public_status','=',1);
        $count = $cargos->count();
        $cargos = $cargos->with('user')->with('sender')->with('receiver')->with('cargoStatus')->paginate(10);
        
        $users = User::where('company_id','=',Auth::user()->company_id)->get();

        $statuses = CargoStatus::where('company_id','=',Auth::user()->company_id)->get();
    	return view('admin.cargo.index',compact('cargos','statuses','users','count'));
    }
    
    /*
    * Cargo create page
    * @return response
    */
    public function create()
    {
        // if user has not permission create cargo
        if(!Permission::check('cargo-create'))
        {
            abort('419');
        }

        $cities = City::all();
        // get statuses for use cargo crate page
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        return view('admin.cargo.create',compact('statuses','cities'));
    }

    /*
    * Cargo show and Edit page
    * @param $request array
    * @return response
    */
    public function show(Request $request)
    {
        // if user has not permission show cargo return 419 error
        if(!Permission::check('cargo-show'))
        {
            abort('419');
        }
        // get cargo data according to request id
        $cargo = Cargo::find(decrypt($request->id));

        // get cities
        $cities = City::all();

        // get status datas for use show cargo page
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();

        // get product datas according cargo id
        $products = Product::where('cargo_id',$cargo->id)->get();

        return view('admin.cargo.show',compact('cargo','products','statuses','cities'));
    }

    /*
    * Delete Carog
    * @param $request array
    * @return redirect
    */
    public function delete(Request $request)
    {
        // get data according to id and delete then return back success message
        $cargo = Cargo::find($request->id);
        $cargo->delete();
        return back()->with(['success'=>'Silindi!']);
    }

    /*
    * Filter Cargo
    * @param $request array
    * @return response
    */
    public function filter(Request $request)
    {
        $users = User::where('company_id','=',Auth::user()->company_id)->get();
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        $cargos = Cargo::where('company_id',Auth::user()->company_id);

        if($request->type != '')
        {
            $cargos->where('type','=',$request->type)->get();
        }
        if($request->baza != '')
        {
            $cargos->where('baza','=',$request->baza)->get();
        }
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
        $cargos = $cargos->orderBy('id','DESC');
        $count = $cargos->count();
        $cargos = $cargos->with('user')->with('receiver')->with('sender')->with('cargoStatus')->paginate(15);
        $cargos->appends(['start' => $request->start,'end'=>$request->end,'status'=>$request->status,'user'=>$request->user]);
        
        return view('admin.cargo.index',compact('cargos','statuses','users','count'));
    }

    /*
    * Change status
    * @param $request array
    * @return redirect
    */
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

    /*
    * Make log
    * @param $id integer
    * @param $status string
    * @return boolean
    */
    public function storeLog($id,$status)
    {
        $cargoLog = new CargoLog();
        $cargoLog->cargo_id = $id;
        $cargoLog->cargo_status_id = $status;
        $cargoLog->save();
        $status = CargoStatus::find($status);
        
        if($status->send_phone == 'true')
        {
            $this->sendPhone($id,$status->name,$status->sms_message);
            $this->sendPhoneUz($id,$status->name,$status->sms_message);
        }

    }

    /*
    * Make Barcode
    * @param $data string
    * @return string
    */
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

    /*
    * Save Cargo
    * @param $request array
    * @return redirect
    */
    public function storeAll(Request $request)
    {
        if(!Permission::check('cargo-create'))
        {
            abort('419');
        }
        # save sender 
        $sender_id = $this->storeCustomer($request);

        # save receiver
        $receiver_id = $this->storeReceiver($request);

        # get company of user
        $company = Company::find(Auth::user()->company_id);
        # increase cargo row
        $cargo_row = $company->cargo_row + 1;
        # set increased cargo
        $company->cargo_row = $cargo_row;
        # save
        $company->save();

        # get cargo status
        $status = CargoStatus::find($request->status);

        # create new cargo
        $cargo = new Cargo();
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->type = $request->type;
        $cargo->baza  = $request->baza;
        $cargo->public_status = $status->public_status;
        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_price_tr = $request->sender_price_tr;
        $cargo->sender_price_usd = $request->sender_price_usd;
        $cargo->receiver_price_uz = $request->receiver_price_uz;
        $cargo->receiver_price_usd = $request->receiver_price_usd;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        $cargo->user_id = Auth::user()->id;

        $cargo->number = Auth::user()->company->cargo_letter.sprintf("%05s",$company->cargo_row);
        $cargo->save();
        $cargo_id = $cargo->id;

        $total_price = 0;

        # log cargo record
        $this->storeLog($cargo->id,$cargo->status);

        # here we are saving products of cargo
        foreach ($request->product_name as $key=> $name)
        {
            if($name != '')
            {
                # create new product
                $product = new Product();
                $product->name = $request->product_name[$key];
                $product->count = $request->product_count[$key] ?? 0;
                $product->cost = $request->product_price[$key] ?? 0;
                $product->total = $request->product_total_price[$key] ?? 0;
                $product->cargo_id = $cargo_id;
                $product->save();

                # define total price
                $total_price += $request->product_total_price[$key];
            }
        }
        # here we are setting total price of cargo
        $cargo = Cargo::find($cargo_id);
        $cargo->total_price = $total_price;
        $cargo->save();

        return redirect()->route('cargo.show',encrypt($cargo->id))->with(['success'=>'Kaydedildi!']);
    }

    /*
    * Update Cargo
    * @param $request array
    * @return redirect
    */
    public function updateAll(Request $request)
    {
        
        # update or save sender
        $sender_id = $this->storeCustomer($request);

        # update or save receiver
        $receiver_id = $this->storeReceiver($request);

        # get cargo by id
        $cargo = Cargo::find($request->cargo_id);

        # make log if status is different 
        if($cargo->status != $request->status)
        {
            # make log
            $this->storeLog($cargo->id,$request->status);
        }
        # get status by id
        $status = CargoStatus::find($request->status);
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->public_status = $status->public_status;
        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_price_tr = $request->sender_price_tr;
        $cargo->sender_price_usd = $request->sender_price_usd;
        $cargo->receiver_price_uz = $request->receiver_price_uz;
        $cargo->receiver_price_usd = $request->receiver_price_usd;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        $cargo->baza = $request->baza;
        $cargo->save();
        $cargo_id = $cargo->id;

        $total_price = '0';

        # here we are getting update product of cargo
        foreach ($request->product_name as $key=> $name)
        {
            if($request->product_id[$key] != '')
            {
                # get product by id
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

        return redirect()->route('cargo.show',encrypt($cargo->id))->with(['success'=>'Güncellendi!']);
    }

    /*
    * Print cargo
    * @param $request array
    * @return response
    */
    public function print(Request $request)
    {

        $cargo = Cargo::find(decrypt($request->id));
        $barcode = $this->getBarcode($cargo->number);
        $products = Product::where('cargo_id',$cargo->id)->get();
        $company = Company::find(Auth::user()->company_id);
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();

        return view('admin.cargo.print',compact('cargo','products','barcode','company','statuses'));
    }

    /*
    * Update Sender
    * @param $request array
    * @return string
    */
    public function storeCustomer($request)
    {
        # get sender by phone
        $sender = Customer::where('phone','=',$request->sender_phone)
        ->where('company_id','=',Auth::user()->company_id)
        ->get()->first();

        # create new customer if has not 
        if(!$sender){ $sender = new Customer();}

        $sender->name = strtoupper($request->sender_name);
        $sender->phone_code = $request->sender_phone_code;
        $sender->phone = $request->sender_phone;
        $sender->company_id = Auth::user()->company_id;
        $sender->save();

        return $sender->id;
    }

    /*
    * CRETE OR Update Receiver
    * @param $request array
    * @return string
    */
    public function storeReceiver($request)
    {
        # get receiver by phone number
        $receiver = Receiver::where('phone','=',$request->receiver_phone)
        ->where('company_id','=',Auth::user()->company_id)
        ->get()->first();

        # create new recevier if has not
        if(!$receiver){ $receiver = new Receiver(); }

        $receiver->name = strtoupper($request->receiver_name);
        $receiver->passport = strtoupper($request->receiver_passport);
        $receiver->phone_code = $request->receiver_phone_code;
        $receiver->phone = $request->receiver_phone;
        $receiver->other_phone = $request->receiver_other_phone;
        $receiver->city  = $request->city;
        $receiver->address = strtoupper($request->receiver_address);
        $receiver->company_id = Auth::user()->company_id;
        $receiver->save();
        return  $receiver->id;
    }

    /*
    * Make excel
    * @param $request array
    * @return Excel file
    */
    public function manafesExcel(Request $request)
    {
        $cargos = Cargo::where('company_id',Auth::user()->company_id);

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

        if($request->status != '')
        {
            $cargos->where('status','=',$request->status);
        }
        if($request->category != '')
        {
            $cargos->where('type','=',$request->category)->get();
        }
        if($request->user != '')
        {
            $cargos->where('user_id','=',$request->user);
        }

        $cargos = $cargos->orderBy('id','ASC')->get();
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

        // make excell manafes
        if($request->type == 'kargo')
        {
            $datas = [
                    [ 'KOD','Yuboruvchi','Tel','Oluvchi','Tel','Kilo','Turkiya Tulov','UZB Tulov'],
                ];
            foreach ($cargos as $key => $value)
            {
                $data = [
                            $value->number ?? '',
                            $value->sender->name,
                            $value->sender->phone,
                            $value->receiver->name ?? '',
                            $value->receiver->phone ?? '',
                            $value->total_kg ?? '',
                            $value->sender_price_tr.' TL - '.$value->sender_price_usd.' USD',
                            $value->receiver_price_uz.' SUM - '.$value->receiver_price_usd.' USD',
                        ];

                array_push($datas, $data);

            }


            $date = date('d.m.Y');
            $filename = $date.'-harajatlar.xlsx';
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

    /*
    * Search Cargo
    * @param $request array
    * @return json
    */
    public function search(Request $request)
    {
        $key = $request->key;
        if($key == ''){ return json_encode(['cargo'=>'']); }

        $cargos = Cargo::orWhereHas('sender',function($query) use ($key){
            $query->where('name','like','%'.$key.'%');
        })->orWhereHas('receiver',function($query) use ($key){
            $query->where('name','like','%'.$key.'%');
        })->orWhere('number','like','%'.$key.'%')->with('user')->with('sender')->with('receiver')->with('cargoStatus')->paginate(10);
        $count = $cargos->count();
        $html = View::make('admin.cargo.search_result', compact('cargos'))->render();
        return Response::json(['html' => $html,'count'=>$count]);
    }

    /*
    * Send message to turkish mobile phone
    * @param $id integer
    * @param $status string
    * @param $sms_message string
    * @return boolean
    */
    public function sendPhone($id,$status,$sms_message)
    {
        $message  = '';
        $cargo    = Cargo::find($id);
        $message .= 'Kargo KODİ: '.$cargo->number.PHP_EOL;
        $message .= 'Status: '.$status.PHP_EOL;
        $message .=  $sms_message.PHP_EOL;
        $message .= 'Online Tekshirish uchun link '.PHP_EOL;
        $message .= 'https://portalkargo.com'.PHP_EOL;
        $message .= 'Operator tel: +908504411101'.PHP_EOL;
        $sms = new SendSMS();
        $code = $cargo->sender->phone_code ? $cargo->sender->phone_code : '';
        return $sms->sendSms($message,trim($code.$cargo->sender->phone));

    }

    /*
    * Send message to uzbek mobile phone
    * @param $id integer
    * @param $status string
    * @param $sms_message string
    * @return boolean
    */
    public function sendPhoneUz($id,$status,$sms_message='')
    {
        $message  = '';
        $cargo    = Cargo::find($id);
        $message .= 'Kargo KODİ: '.$cargo->number.PHP_EOL;
        $message .= 'Status: '.$status.PHP_EOL;
        $message .=  $sms_message.PHP_EOL;
        $message .= 'Online Tekshirish uchun link '.PHP_EOL;
        $message .= 'https://portalkargo.com'.PHP_EOL;
        $message .= 'Operator tel: +908504411101'.PHP_EOL;
        $sms = new SendSMS();
        $code = $cargo->receiver->phone_code ? $cargo->receiver->phone_code : '998';
        $tel = $cargo->receiver->phone;
        if(strlen($tel) != 12)
        {
            $tel = $code.str_replace([' ',',','  '],'',$cargo->receiver->phone);
        }
        return $sms->sendSmsUz($message,trim($tel));
    }


}
