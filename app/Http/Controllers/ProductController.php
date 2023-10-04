<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::get();
        if(!$request->ajax()) return view("products.index");
        return response()->json($products, 200);
    }


    public function getProduct(Request $request, $id)
    {
        if(!$request->ajax()) return view("products.productView", compact('id'));
        $product = Product::find($id);
        return response()->json($product, 200);
    }

    public function create(Request $productRequest)
    {
        $product = new Product($productRequest->all());
        $product->save();
        if (!$productRequest->ajax()) return back()->with('success', 'product created');
        return response()->json(['status' => 'product created', 'product' => $product], 201);
    }

    public function modify(Request $productRequest)
    {
        $product = Product::find($productRequest->id);
        $product->name        = $productRequest->name;
        $product->description = $productRequest->description;
        $product->price       = $productRequest->price;
        $product->stock       = $productRequest->stock;
        $product->save();
        if (!$productRequest->ajax()) return back()->with('success', 'product modified');
        return response()->json(['status' => 'product modified', 'product' => $product], 201);
    }

    public function destroy(Request $req, $id)
    {
        $product = Product::find($id);
        $product->delete();
        if (!$req->ajax()) return back()->with('success', 'product deleted');
        return response()->json(['status' => 'product deleted', 'user' => $product], 201);
    }
}
