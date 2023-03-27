<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail_Transaksi;
use App\Models\Header_Transaksi;
use App\Models\Product;
use FontLib\EOT\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiAPIController extends Controller
{
    public function transaksi(Request $request) {
        $product = Product::where('name',$request->product)->first();
        $quantity = $request->quantity;
        $bayar = $request->pembayaran;
        $grandtotal=0;

        $harga = $product->price;
        $total = $harga * $quantity;
        $grandtotal += $total;
        
        if($request->pembayaran < $grandtotal) {
            return response()->json(['status' => 'error','message' => 'Nominal pembayaran kurang dari total barang!'], 400);
        } else {
            Header_Transaksi::create([
                "tanggal_transaksi" => date('Y-m-d'),
                "user_id" => 2
            ]);

            $header = DB::table('header_transaksi')->pluck('id_header_transaksi')->first();

                $id = $product->product_id;
                $data = $product->stock;
                $stock = $data - $quantity;
                $product->stock = $stock;
                $product->save();
                Detail_Transaksi::create([
                    "product_id" => $id,
                    "id_header_transaksi" => $header,
                    "quantity" => $quantity,
                    "harga_total" => $total
                ]);
        }

        Header_Transaksi::where('id_header_transaksi',$header)->update([
            "total" => $grandtotal,
            "pembayaran" => $bayar,
        ]);

        $user = 2;
        $data = Header_Transaksi::where('user_id',$user)->first();
        $detail = Detail_Transaksi::where('id_header_transaksi',$header)->first();
        $kembalian = $bayar - $grandtotal;

        return response()->json(['status' => 'success','message' => 'Transaksi Berhasil',
                                'data' => $data,
                                'detail' => $detail,
                                'kembalian' => $kembalian]);

    }
}
