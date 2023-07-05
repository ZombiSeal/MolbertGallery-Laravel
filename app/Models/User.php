<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends  Authenticatable
{
    use HasFactory;
    protected $table = "users";
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'id_user';

}
