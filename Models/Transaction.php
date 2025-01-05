<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
