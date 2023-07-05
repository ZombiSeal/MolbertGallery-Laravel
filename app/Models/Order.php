<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = "id_order";

    public function info()
    {
        return $this->hasOne(OrderInfo::class, 'id_info', 'id_info');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id_product', 'id_product');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'id_sale', 'id_sale');
    }

    public function status()
    {
        return $this->hasOneThrough(Status::class,OrderInfo::class, 'id_info', 'id_status','id_info', 'id_status');
    }

    public function author()
    {
        return $this->hasOneThrough(Author::class,Product::class, 'id_product', 'id_auther','id_product', 'id_auther');
    }

}
