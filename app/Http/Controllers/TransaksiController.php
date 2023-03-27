<?php

namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use App\Models\Header_Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{

    public function recap() {
        $data = Header_Transaksi::all();
        return view('admin.recap')->with('data',$data);
    }

    public function detail($id_header_transaksi) {
       $header = Header_Transaksi::where('id_header_transaksi',$id_header_transaksi)->first();
       $detail = Detail_Transaksi::where('id_header_transaksi',$id_header_transaksi)->get();

        return view('admin.detail')->with(['header' => $header,'detail' => $detail]);
    }

    public function index() {
        $user = auth()->id();
        $data = Header_Transaksi::where('user_id',$user)->get();
        return view('user.transaksi')->with('data',$data);
    }

    public function cetak_struk($id_header_transaksi) {
        $header = Header_Transaksi::where('id_header_transaksi',$id_header_transaksi)->first();
        $detail = Detail_Transaksi::where('id_header_transaksi',$id_header_transaksi)->get();

        // return view('user.struk')->with(['header' => $header,'detail' => $detail]);
        $pdf = Pdf::loadview('user.struk',['header' => $header,'detail' => $detail]);
    	return $pdf->download('Struk-Transaksi-'.$header->created_at.'.pdf');

        return redirect('user/transaksi')->with('struk','The proof of transaction receipt has been successfully downloaded');
    }
}
