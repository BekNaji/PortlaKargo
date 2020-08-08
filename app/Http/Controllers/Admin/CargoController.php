<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\CargoStatus;
use App\Models\CargoLog;
use App\Models\Product;
use App\Models\Company;
use Auth;
use App;
use Illuminate\Support\Carbon;



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

    public function edit(Request $request)
    {

        $cargo = Cargo::find(decrypt($request->id));
        $statuses = CargoStatus::all();
        
        return view('admin.cargo.edit',compact('cargo','statuses'));
    }

    public function show(Request $request)
    {
        $cargo = Cargo::find(decrypt($request->id));
        $products = Product::where('cargo_id',$cargo->id)->get();
        
        return view('admin.cargo.show',compact('cargo','products'));
    }

    public function store(Request $request)
    {
    	
        $cargo = new Cargo();
        $cargo->company_id = Auth::user()->company_id;
        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->total_kg = $request->total_kg;
        $cargo->save();

        $cargo = Cargo::find($cargo->id);
        $cargo->number = Auth::user()->company->cargo_letter.sprintf("%05s",$cargo->id);
        $cargo->save();


        $this->storeLog($cargo->id,$cargo->status);

        return redirect()->route('cargo.show',encrypt($cargo->id));      
    }

    public function update(Request $request)
    {
        
        $cargo = Cargo::find($request->id);
        
        if($cargo->status != $request->status)
        {
            $this->storeLog($cargo->id,$request->status);
        } 

        $cargo->payment_type = $request->payment_type;
        $cargo->status = $request->status;
        $cargo->total_kg = $request->total_kg;
        $cargo->save();

        return redirect()->route('cargo.show',encrypt($cargo->id));
          
    }

    public function delete(Request $request)
    {
        $cargo = Cargo::find($request->id);
        $cargo->delete();
        return back()->with(['success'=>'Silindi!']);
    }

  

    public function pdf(Request $request)
    {

        $cargo = Cargo::find(decrypt($request->id));
        $barcode = $this->getBarcode($cargo->number);
        $products = Product::where('cargo_id',$cargo->id)->get();
        $company = Company::find(Auth::user()->company_id);

    

        return view('admin.cargo.pdf',compact('cargo','products','barcode','company'));
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


}
