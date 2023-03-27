<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'table_diskon';
    protected $primaryKey = 'id';
    protected $fillable = ['code','discount','minimal','limit'];
    
}
