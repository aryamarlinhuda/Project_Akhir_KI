<?php

namespace App\Http\Controllers;

use App\Models\Header_Transaksi;
use App\Models\MembershipExchange;
use App\Models\MembershipProduct;
use App\Models\User;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function dashboard() {
        $user = auth()->id();
        $data = Header_Transaksi::where('user_id',$user)->sum('total');
        $member = User::where('id',$user)->first();
        return view('user.dashboard')->with(['data' => $data, 'member' => $member]);
    }

    public function index() {
        $data = MembershipProduct::all();

        return view('user.membership.membership')->with('data',$data);
    }

    public function detail($id) {
        $data = MembershipProduct::where('id', $id)->first();
        return view('user.membership.detail-membership')->with('data', $data);
    }

    public function order(Request $request, $id) {
        $item = session('item');
        $product = MembershipProduct::where('id',$id)->first();

        $item[$id] = [
            "name" => $product->name,
            "point" => $product->point,
            "quantity" => $request->quantity
        ];

        session(['item' => $item]);

        return redirect('user/membership/order')->with('add','The membership product has been successfully added');
    }

    public function data() {
        $item = session('item');

        return view('user.membership.order-membership')->with('item',$item);
    }

    public function delete($id) {
        $item = session('item');
        unset($item[$id]);
        session(['item' => $item]);
        return redirect('user/membership/order')->with('delete','Membership Product successfully removed');
    }

    public function exchange() {
        $item = session('item');
        $user  = auth()->user()->id;
        $point = auth()->user()->point;
        $total_points = 0;

            foreach($item as $ct => $data) {
                $id = $ct;
                $quantity = $data['quantity'];
                $product = MembershipProduct::find($id);
                $total = $product->point * $quantity;
                $total_points += $total;
                if($point > $total_points) {
                    
                    $stock = $product->stock - $quantity;
                    $product->stock = $stock;
                    $product->save();
                    
                    $sisa = $point - $total_points;
                    User::where('id',$user)->update([
                        "point" =>$sisa
                    ]);

                    MembershipExchange::create([
                    "user_id" => $user,
                    "product_id" => $id,
                    "tanggal_penukaran" => date('Y-m-d'),
                    "quantity" => $data['quantity'],
                    "total_points" => $total
                    ]);
                } else {
                    return redirect('user/membership/order')->with('min','Your points are not enough to exchange products');
                }
            }

        session()->forget('item');
        return redirect('user/membership/history')->with('add','The product was purchased successfully by exchanging membership points');
    }

    public function history() {
        $user = auth()->id();
        $data = MembershipExchange::where('user_id',$user)->get();

        return view('user.membership.history-membership')->with('data',$data);
    }

    public function recap() {
        $data = MembershipExchange::all();

        return view('admin.membership.recap-membership')->with('data', $data);
    }
}
