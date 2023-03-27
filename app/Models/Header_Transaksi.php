<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Header_Transaksi extends Model

{
    use HasFactory;

    protected $table = 'header_transaksi';

    protected $primaryKey = 'id_header_transaksi';

    protected $fillable = ['user_id','tanggal_transaksi','total','discount_id','discount','total_pembelian','pembayaran'];

    static function add_header_transaksi() {
        $user = auth()->id();
        $data = Header_Transaksi::create([
            "tanggal_transaksi" => date('Y-m-d'),
            "user_id" => $user
        ]);
        
        return $data->id_header_transaksi;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function id_disc()
    {
        return $this->belongsTo(Discount::class,'discount_id');
    }
}
