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
use Illuminate\Support\Carbon;
use Excel;
use Illuminate\Support\Facades\Http;
use App\Helpers\SendSMS;



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

    public function index()
    {
    	$cargos  = Cargo::where('company_id',Auth::user()->company_id)
        ->orderBy('id','DESC')->get();

        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
    	return view('admin.cargo.index',compact('cargos','statuses'));
    }

    public function create()
    {
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        return view('admin.cargo.create',compact('statuses'));
    }

    public function edit(Request $request)
    {

        $cargo = Cargo::find(decrypt($request->id));
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        
        return view('admin.cargo.edit',compact('cargo','statuses'));
    }

    # show cargo info
    public function show(Request $request)
    {
        $cargo = Cargo::find(decrypt($request->id));
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        $products = Product::where('cargo_id',$cargo->id)->get();
        
        return view('admin.cargo.show',
               compact('cargo','products','statuses'));
    }
    
    # delete cargo
    public function delete(Request $request)
    {
        $cargo = Cargo::find($request->id);
        $cargo->delete();
        return back()->with(['success'=>'Silindi!']);
    }

    # make filter
    public function filter(Request $request)
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
        
        if($request->status != 'all')
        {
            $cargos->where('status','=',$request->status);
        }
        $cargos = $cargos->orderBy('id','DESC')->get();

        
      
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        
        return view('admin.cargo.index',compact('cargos','statuses'));
    }

    # change status
    public function changeStatus(Request $request)
    {
        $ids = explode(',', $request->ids);
        
        foreach ($ids as $key => $id) 
        {
            $cargo = Cargo::find($id);
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
        //$this->sendMessage($id,$status->name);

        if($status->send_phone == 'true')
        {
            $this->sendPhone($id,$status->name);
        }

    }

    # make barcode
    public function getBarcode($data)
    {
        //Generate into customize folder under public
        $bar = App::make('BarCode');
        $barcode = [
            'text' => $data,
            'size' => 30,
            'orientation' => 'horizontal',
            'code_type' => 'code39',
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
        
        $sender_id = $this->storeCustomer($request);

        $receiver_id = $this->storeReceiver($request);

        $company = Company::find(Auth::user()->company_id);

        $company->cargo_row++;
        $company->save();


        $cargo = new Cargo();
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        
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
                $product->count = $request->product_count[$key];
                $product->cost = $request->product_price[$key];
                $product->total = $request->product_total_price[$key];
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

        $sender_id = $this->storeCustomer($request);

        $receiver_id = $this->storeReceiver($request);

        $cargo = Cargo::find($request->cargo_id);

        if($cargo->status != $request->status)
        {
            $this->storeLog($cargo->id,$request->status);

        }
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        $cargo->save();

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
                    $product->name = $request->product_name[$key];
                    $product->count = $request->product_count[$key];
                    $product->cost = $request->product_price[$key];
                    $product->total = $request->product_total_price[$key];
                    $total_price += $request->product_total_price[$key];
                    $product->cargo_id = $cargo_id;
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
        $sender = Customer::where('phone','=',$request->sender_phone)->get()->first();

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
        $receiver = Receiver::where('phone','=',$request->receiver_phone)->get()->first();
        if(!$receiver)
        {
            $receiver = new Receiver();
        }
        $receiver->name = strtoupper($request->receiver_name);
        $receiver->passport = strtoupper($request->receiver_passport);
        $receiver->phone = $request->receiver_phone;
        $receiver->address = strtoupper($request->receiver_address);
        $receiver->company_id = Auth::user()->company_id;
        $receiver->save();
        return  $receiver->id;
    }

    # make excel
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
        
        if($request->status != 'all')
        {
            $cargos->where('status','=',$request->status);
        }
        $cargos = $cargos->get();



        

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

        if($request->type == 'baza')
        {
            
            $datas = [
                    ['Invoice No','Tarih','Sender','Sender Tel','Recevier','Receiver Tel:1','Receiver Tel:2','Address','Total KG','Total Price','Passport','']
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
                

                $data = [   
                        $cargo->number ?? '',
                        $cargo->created_at ?? '',
                        $cargo->sender->name ?? '',
                        $cargo->sender->phone ?? '',
                        $cargo->receiver->name ?? '',
                        $cargo->receiver->phone ?? '',
                        $cargo->receiver->other_phone ?? '',
                        $cargo->receiver->address ?? '',
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

    # send message to user with telegram bot
    public function sendMessage($id,$status)
    {
        $message = '';
        $cargo = Cargo::find($id);

        $message .= '<b>Şirket adı:</b> '.$cargo->company->name.' '.PHP_EOL;
        $message .= '<b>Kargo Durumu: </b>'.$status.' '.PHP_EOL;
        $message .='<b>Kargo Takip No : </b>'.$cargo->number.' '.PHP_EOL;
        $message .= '<b>Gönderici: </b>'.$cargo->sender->name ?? '-';
        $message .= PHP_EOL;
        $message .= '<b>Alıcı: </b>'.$cargo->receiver->name ?? '-';
        $message .= PHP_EOL;
        if($cargo->company->telegram_url != '')
        {
            $url = $cargo->company->telegram_url;

            if($cargo->sender->telegram_id != '')
            {

                $response = Http::post($url.'sendMessage.php',
                [
                    'id' => $cargo->sender->telegram_id,
                    'message' => $message,
                ]);
            }

            if($cargo->receiver->telegram_id != '')
            {
                $response = Http::post($url.'sendMessage.php',
                [
                    'id' => $cargo->receiver->telegram_id,
                    'message' => $message,
                ]);
            }
            
        }
        
        return ;
    }

    public function sendPhone($id,$status)
    {
        $message = 'Sn. Müşterimiz ';
        $cargo = Cargo::find($id);
        $message .= $cargo->number;
        $message .= ' nolu gonderi hk bilgi!'.PHP_EOL;
        $message .= 'Status: '.$status.PHP_EOL;
        
        $sms = new SendSMS();
        
        return $sms->sendSms($message,$cargo->sender->phone);
        
    }

}
