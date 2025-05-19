<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'stock',
        'price',
        'is_active',
        'barcode',
        'image',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
