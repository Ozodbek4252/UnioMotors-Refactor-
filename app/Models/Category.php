<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'brend_id',
        'photo',
        'name_uz',
        'name_ru',
        'name_en',
        'name_en',
    ];

    // public function brends()
    // {
    //     return $this->belongsTo(Brend::class, 'brend_id');
    // }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
