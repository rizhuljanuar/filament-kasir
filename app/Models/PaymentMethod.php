<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'image',
        'is_cash',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
