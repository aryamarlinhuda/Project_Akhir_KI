<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Header_Transaksi;
use App\Models\Product;
use App\Models\User;
use FontLib\EOT\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function list() {
        $data = Discount::all();

        return view('admin.discount.discount')->with('data',$data);
    }

    public function index() {
        $data = Discount::all();
        $id = auth()->id();
        foreach($data as  $x => $item) {
            $diskon = $item->id;
            $used = Header_Transaksi::where('user_id',$id)->where('discount_id',$diskon)->count();            
            $limit = $item->limit;
            $sisa = $limit - $used;
            $data[$x]->sisa = $sisa;
            $habis = $sisa;
        }
        
        return view('user.discount')->with(['data' => $data, 'habis' => $habis]);


    }

    public function create() {
        $data = Product::all();

        return view('admin.discount.create-discount')->with('data',$data);
    }

    public function create_process(Request $request) {
        $request->validate([
            "code" => "required",
            "discount" => "required",
        ]);

        $data = [
            "code" => $request->code,
            "discount" => $request->discount,
            "product_id" => $request->product_id,
            "minimal" => $request->minimal,
            "limit" =>$request->limit
        ];

        Discount::create($data);
        return redirect('admin/discount')->with('create','Discount successfully created');
    }

    public function update($id) {
        $data = Discount::where('id',$id)->first();
        $product = Product::all();

        return view('admin.discount.update-discount')->with(['data' => $data, 'product' => $product]);
    }

    public function update_process(Request $request, $id) {
        $request->validate([
            "code" => "required",
            "discount" => "required",
        ]);

        $data = [
            "code" => $request->code,
            "discount" => $request->discount,
            "product_id" => $request->product_id,
            "minimal" => $request->minimal,
            "limit" =>$request->limit
        ];

        Discount::where('id',$id)->update($data);
        return redirect('admin/discount')->with('update','Discount successfully updated');
    }

    public function delete($id) {
        Discount::where('id',$id)->delete();
        return redirect('admin/discount')->with('delete','Discount successfully removed');
    }
}
