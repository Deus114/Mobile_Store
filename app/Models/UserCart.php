<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name','image', 'price', 'quantity','user_id','product_id'];

}
