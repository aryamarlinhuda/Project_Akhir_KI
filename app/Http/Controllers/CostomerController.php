<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CostomerController extends Controller
{
    public function index() {
        $data = User::where('role','user')->get();
        return view('admin.customers.customers')->with('data',$data);
    }

    public function update($id) {
        $data = User::where('id',$id)->first();
        return view('admin.customers.customer-update')->with('data',$data);
    }

    public function update_process(Request $request, $id) {
        $data = [
            "membership" => $request->membership,
        ];

        User::where('id',$id)->update($data);
        return redirect('admin/customers')->with('update','Customer membership has been successfully updated');
    }
}
