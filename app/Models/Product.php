<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = 'id_product';
    protected $guarded = [];
    public $timestamps = false;

    public function author()
    {
        return $this->hasOne(Author::class, 'id_auther', 'id_auther');
    }

    public function size()
    {
        return $this->hasOne(Size::class, 'id_size', 'id_size');
    }

}
