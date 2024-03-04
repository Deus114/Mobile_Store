<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'name',
        'phone',
        'email',
        'address',
        'payment',
        'totalQuantity',
        'totalPrice',
        'code',
        'user_id'
    ];
}
