<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CRUDProductController extends Controller
{
    public function list() {
        $data = Product::all();

        return response()->json(['status' => 'success', 'data' => $data], 201);
    }

    public function create(Request $request) {
        $data = Product::create([
            "name" => $request->name,
            "picture" => $request->picture,
            "description" => $request->description,
            "category" => $request->category,
            "stock" => $request->stock,
            "price" => $request->price,
            "point" => $request->point
        ]);

        if($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }

        return response()->json(['status' => 'success', 'message' => 'Product Successfully Created','data' => $data], 201);
    }

    public function update(Request $request, $id) {
        $data = [
            "name" => $request->name,
            "picture" => $request->picture,
            "description" => $request->description,
            "category" => $request->category,
            "stock" => $request->stock,
            "price" => $request->price,
            "point" => $request->point
        ];

        if($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }

        Product::where('product_id',$id)->update($data);
        return response()->json(['status' => 'success', 'message' => 'Product Successfully Updated', 'data' => $data], 201);
    }

    public function delete($id) {
        Product::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Product Successfully Deleted'], 201);
    }
}
