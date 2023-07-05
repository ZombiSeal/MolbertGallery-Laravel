<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;
    protected $table = "orders_info";
    protected $primaryKey ="id_info";
    protected $guarded = [];
    public $timestamps = false;

}
