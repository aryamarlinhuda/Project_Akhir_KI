<?php

namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use App\Models\Discount;
use App\Models\Header_Transaksi;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductUserController extends Controller
{
    public function product(Request $request) {
        $data = Product::all();
        return view('user.products.product')->with('data', $data);
    }

    public function category($category) {
        $data = Product::where('category',$category)->get();
        $name = Product::where('category',$category)->first();
        return view('user.products.filter-product')->with(['data' => $data,'name' => $name]);
    }

    public function detail($product_id) {
        $data = Product::where('product_id', $product_id)->first();
        return view('user.products.detail-product')->with('data', $data);
    }

    public function order(Request $request, $product_id) {
        $data = session('data');
        $product = Product::detail_product($product_id);

        $data[$product_id] = [
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => $request->quantity
        ];

        session(['data' => $data]);

        return redirect('user/order')->with('add','The product has been successfully added to the cart');
    }

    public function data() {
        $data = session('data');
        $diskon = Discount::all();        
        return view('user/order')->with(['data' => $data, 'diskon' => $diskon]);
    }

    public function delete($product_id) {
        $data = session('data');
        unset($data[$product_id]);
        session(['data' => $data]);
        return redirect('user/order')->with('delete','Product successfully removed from chart');
    }

    public function add_transaksi(Request $request) {
        $data = session('data');
        $grandtotal = 0;
        $pembayaran = $request->pembayaran;
        $user = auth()->id();

        foreach($data as $ct => $item) {
            $product_id = $ct;
            $quantity = $item['quantity'];
            $product = Product::find($product_id);
            $subtotal = $item['price'] * $item['quantity'];
            $subtotal = $subtotal;
            $grandtotal += $subtotal;
        }

        if($request->pembayaran < $grandtotal) {
            return redirect('user/order')->with('kurang','The paymment must have a value graeter than the total price');
        } else {
            $id_header_transaksi = Header_Transaksi::add_header_transaksi();
            foreach($data as $ct => $item) {
                $product_id = $ct;
                $quantity = $item['quantity'];
                $product = Product::find($product_id);
                $stock = $product->stock - $quantity;
                $product->stock = $stock;
                $product->save();
                $point = $product->point * $quantity;
                Detail_Transaksi::add_detail_transaksi($product_id,$id_header_transaksi,$quantity,$subtotal);
            }
        }


        Header_Transaksi::where('id_header_transaksi', $id_header_transaksi)->update([
            "total" => $grandtotal,
            "pembayaran" => $pembayaran,
        ]);

        User::membership();

        $users = User::find($user);
        $membership = $users->membership;
        if($membership == 1) {
            $tambah = $users->point + $point;
            User::where('id',$user)->update([
                "point" => $tambah
            ]);
        } else {
            User::where('id',$user)->update([
                "point" => 0
            ]);
        }

        session()->forget('data');
        return redirect('user/transaksi')->with('add','Product successfully purchased');
    }

    public function discount($id) {
        $data = session('data');

        $diskon = Discount::where('id', $id)->first();
        return view('user.potongan')->with(['data' => $data, 'diskon' => $diskon]);
    }

    public function add_transaction(Request $request, $id) {
        $data = session('data');
        $grandtotal = 0;
        $pembayaran = $request->pembayaran;
        $user = auth()->id();
        $diskon = Discount::find($id);

        foreach($data as $ct => $item) {
            $product_id = $ct;
            $subtotal = $item['price'] * $item['quantity'];
            $subtotal = $subtotal;
            $grandtotal += $subtotal;
        }

        $disc = $grandtotal * $diskon->discount/100;
        $total = $grandtotal - $disc;
        $diskon_id = $diskon->id;

        if($request->pembayaran < $total) {
            return redirect('user/order/'.$diskon->id.'/discount')->with('kurang','The paymment must have a value graeter than the total price');
        } else {
            if($diskon->minimal > $grandtotal) {
                return redirect('user/order/'.$diskon->id.'/discount')->with('kurang','Total purchases do not meet the terms and conditions of the discount');
            } else {
                $id_header_transaksi = Header_Transaksi::add_header_transaksi();
                foreach($data as $ct => $item) {
                    $product_id = $ct;
                    $quantity = $item['quantity'];
                    $product = Product::find($product_id);
                    $stock = $product->stock - $quantity;
                    $product->stock = $stock;
                    $product->save();
                    $point = $product->point * $quantity;
                    Detail_Transaksi::add_detail_transaksi($product_id,$id_header_transaksi,$quantity,$subtotal);
                }
            }
        }

        Header_Transaksi::where('id_header_transaksi', $id_header_transaksi)->update([
            "total" => $grandtotal,
            "discount_id" => $diskon_id,
            "discount" => $disc,
            "total_pembelian" => $total,
            "pembayaran" => $pembayaran,
        ]);

        User::membership();

        $users = User::find($user);
        $membership = $users->membership;
        if($membership == 1) {
            $tambah = $users->point + $point;
            User::where('id',$user)->update([
                "point" => $tambah
            ]);
        } else {
            User::where('id',$user)->update([
                "point" => 0
            ]);
        }

        session()->forget('data');
        return redirect('user/transaksi')->with('add','Product successfully purchased');
    }
    
}
