<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $fillable = ['id_header_transaksi','product_id','quantity','harga_total'];

    static function add_detail_transaksi($product_id,$id_header_transaksi,$quantity,$subtotal) {
        Detail_Transaksi::create([
            "product_id" => $product_id,
            "id_header_transaksi" => $id_header_transaksi,
            "quantity" => $quantity,
            "harga_total" => $subtotal
        ]);
    }

    public function product() 
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
