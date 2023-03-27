<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipExchange extends Model
{
    use HasFactory;

    protected $table = 'membership_exchange';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','product_id','tanggal_penukaran','quantity','total_points'];

    public function product_membership() 
    {
        return $this->belongsTo(MembershipProduct::class, 'product_id');
    }

    public function user_exchange()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
