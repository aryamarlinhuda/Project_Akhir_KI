<?php

namespace App\Http\Controllers;

use App\Models\MembershipProduct;
use Illuminate\Http\Request;

class MembershipProductController extends Controller
{
    public function index() {
        $data = MembershipProduct::all();

        return view('admin.membership.membership')->with('data',$data);
    }

    public function create() {
        return view('admin.membership.create-membership');
    }

    public function create_process(Request $request) {
        $data = $request->validate([
            "name" => "required",
            "picture" => "required | image | file | mimes:jpg,jpeg | max:3024",
            "description" => "required",
            "stock" => "required",
            "point" => "required"
        ]);

        if($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }

        MembershipProduct::create($data);
        return redirect('admin/membership')->with('create','Create membership product successfully');
    }

    public function update($id) {
        $data = MembershipProduct::where('id',$id)->first();
        return view('admin.membership.update-membership')->with('data',$data);
    }

    public function update_process(Request $request, $id) {
        $data = $request->validate([
            "name" => "required",
            "picture" => "image | file | mimes:jpg,jpeg | max:3024",
            "description" => "required",
            "stock" => "required | numeric",
            "point" => "required"
        ]);

        if($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }
        
        MembershipProduct::where('id',$id)->update($data);
        return redirect('admin/membership')->with('update','Update membership product successfully');
    }

    public function restock($id) {
        $data = MembershipProduct::where('id',$id)->first();
        return view('admin.membership.restock-membership')->with('data',$data);
    }

    public function restock_process(Request $request, $id) {
        $request->validate([
            "stock" => "required"
        ]);

        $data = $request->stock;

        $product = MembershipProduct::find($id);
        $restock = $product->stock + $data;
        $product->stock = $restock;
        $product->save();

        return redirect('admin/membership')->with('restock','Stock membership product successfully added');
    }

    public function delete($id) {
        MembershipProduct::where('id',$id)->delete();
        return redirect('admin/membership')->with('delete','Delete membership product successfully');
    }
}
