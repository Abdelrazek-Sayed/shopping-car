<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart', 'address', 'name', 'user_id', 'payment_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
