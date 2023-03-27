<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list() {
        $data = Product::all();

        return view('admin.products.product')->with('data',$data);
    }

    public function create() {
        return view('admin.products.create-product');
    }

    public function create_process(Request $request) {
        $data = $request->validate([
            "name" => "required",
            "picture" => "required | image | file | mimes:jpg,jpeg | max:3024",
            "description" => "required",
            "category" => "required",
            "stock" => "required",
            "price" => "required",
            "point" => "required"
        ]);

        if($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }

        Product::create($data);
        return redirect('admin/product')->with('create','Create product successfully');
    }

    public function update($product_id) {
        $data = Product::where('product_id',$product_id)->first();
        return view('admin.products.update-product')->with('data',$data);
    }

    public function update_process(Request $request, $product_id) {
        $data = $request->validate([
            "name" => "required",
            "picture" => "image | file | mimes:jpg,jpeg | max:3024",
            "description" => "required",
            "category" => "",
            "stock" => "required | numeric",
            "price" => "required | numeric",
            "point" => "required"
        ]);

        if($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }
        
        Product::where('product_id',$product_id)->update($data);
        return redirect('admin/product')->with('update','Update product successfully');
    }

    public function restock($product_id) {
        $data = Product::where('product_id',$product_id)->first();
        return view('admin.products.restock')->with('data',$data);
    }

    public function restock_process(Request $request, $product_id) {
        $request->validate([
            "stock" => "required"
        ]);

        $data = $request->stock;

        $product = Product::find($product_id);
        $restock = $product->stock + $data;
        $product->stock = $restock;
        $product->save();

        return redirect('admin/product')->with('restock','Stock product successfully added');
    }

    public function delete($product_id) {
        Product::where('product_id',$product_id)->delete();
        return redirect('admin/product')->with('delete','Delete product successfully');
    }
}
