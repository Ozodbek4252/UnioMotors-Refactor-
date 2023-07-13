<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charactric extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name_uz',
        'name_ru',
        'name_en',
        'data_uz',
        'data_ru',
        'data_en',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
