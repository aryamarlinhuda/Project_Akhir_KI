<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipProduct extends Model
{
    use HasFactory;

    protected $table = 'table_membership_product';
    protected $primaryKey = 'id';
    protected $fillable = ['name','picture','description','category','stock','point'];
    
}
