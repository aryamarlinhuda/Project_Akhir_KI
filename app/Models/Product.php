<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'table_product';
    protected $primaryKey = 'product_id';
    protected $fillable = ['name','picture','description','category','stock','price','point','created_at','updated_at'];

    static function add_product($name, $price) {
        Product::create([
            "name" => $name,
            "price" => $price
        ]);
    }

    static function detail_product($product_id) {
        $data = Product::where('product_id',$product_id)->first();

        return $data;
    }
}
