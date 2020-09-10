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

    public function show(Request $request)
    {
        $cargo = Cargo::find(decrypt($request->id));
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
        $products = Product::where('cargo_id',$cargo->id)->get();
        
        return view('admin.cargo.show',
               compact('cargo','products','statuses'));
    }
    
    public function delete(Request $request)
    {
        $cargo = Cargo::find($request->id);
        $cargo->delete();
        return back()->with(['success'=>'Silindi!']);
    }

 
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
    
    public function storeLog($id,$status)
    {

        $cargoLog = new CargoLog();
        $cargoLog->cargo_id = $id;
        $cargoLog->cargo_status_id = $status;
        $cargoLog->save();

    }

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

    public function storeAll(Request $request)
    {
        
        $sender_id = $this->storeCustomer($request);

        $receiver_id = $this->storeReceiver($request);

        $cargo = new Cargo();
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->total_kg = $request->total_kg;
        $cargo->cargo_price = $request->cargo_price;
        $cargo->sender_id = $sender_id;
        $cargo->receiver_id = $receiver_id;
        $cargo->save();

        $cargo = Cargo::find($cargo->id);
        $cargo->number = Auth::user()->company->cargo_letter.sprintf("%05s",$cargo->id);
        $cargo->save();
        $cargo_id = $cargo->id;
        $total_price = '0';

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

    public function print(Request $request)
    {

        $cargo = Cargo::find(decrypt($request->id));
        $barcode = $this->getBarcode($cargo->number);
        $products = Product::where('cargo_id',$cargo->id)->get();
        $company = Company::find(Auth::user()->company_id);
        $statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();

        return view('admin.cargo.print',compact('cargo','products','barcode','company','statuses'));
    }

    public function storeCustomer($request)
    {
        $sender = Customer::where('phone','=',$request->sender_phone)->get()->first();

        if(!$sender)
        {
            $sender = new Customer();
        }

        $sender->name = $request->sender_name;
        $sender->phone = $request->sender_phone;
        $sender->company_id = Auth::user()->company_id;
        $sender->save();

        return $sender->id;
        
    }

    public function storeReceiver($request)
    {
        $receiver = Receiver::where('phone','=',$request->receiver_phone)->get()->first();
        if(!$receiver)
        {
            $receiver = new Receiver();
        }
        $receiver->name = $request->receiver_name;
        $receiver->passport = $request->receiver_passport;
        $receiver->phone = $request->receiver_phone;
        $receiver->address = $request->receiver_address;
        $receiver->company_id = Auth::user()->company_id;
        $receiver->save();
        return  $receiver->id;
    }

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

        $datas = [
                    [ 'Invoice No','Name','Passport','Total KG','Total Price'],
                ];
        foreach ($cargos as $key => $value) {
            
            $data = [   
                        $value->number ?? '',
                        $value->receiver->name ?? '',
                        $value->receiver->passport ?? '',
                        $value->total_kg ?? '',
                        '$'.$value->total_price ?? ''
                    ];

            array_push($datas, $data);
            
        }
     
        $date = date('d.m.Y');
        $filename = $date.'-manafes.xlsx';
        return Excel::download(new App\Exports\CargoExcel($datas), $filename);
    }

}
