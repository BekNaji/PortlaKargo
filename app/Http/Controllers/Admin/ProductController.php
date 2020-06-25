<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cargo;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    	$products = Product::where('cargo_id',$request->id)->get();
        $cargoId = $request->id;
       
    	return view('admin.product.index',compact('products','cargoId'));
    }

    public function create()
    {
        return view('admin.product.create');
        
    }

    public function store(Request $request)
    {
    	$product = new Product();
        $product->name = strtoupper($request->name);
        $product->count = strtoupper($request->count);
        $product->cost = strtoupper($request->cost);
        $product->total = strtoupper($request->count*$request->cost);
        $product->cargo_id = strtoupper($request->cargoId);
        $product->save();

        $this->calculateTotalPrice($request->cargoId);

        return back()->with(['success'=>'Ürün eklendi!']);

    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = strtoupper($request->name);
        $product->count = strtoupper($request->count);
        $product->cost = strtoupper($request->cost);
        $product->total = strtoupper($request->count*$request->cost);
        $product->cargo_id = strtoupper($request->cargoId);
        $product->save();

        $this->calculateTotalPrice($request->cargoId);

        return back()->with(['success'=>'Ürün bilgileri gümcellendi!']);

    }

    

    // delete function
    public function delete(Request $request)
    {
    	$product = Product::find($request->id);
        $product->delete();
        $this->calculateTotalPrice($request->cargoId);
        return back()->with(['success'=>'Silindi!']);
    }

    public function calculateTotalPrice($cargoId)
    {
        $products = Product::where('cargo_id',$cargoId)->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->total;
        }
        $cargo = Cargo::find($cargoId);
        $cargo->total_price = $total;
        $cargo->save();
    }
}
