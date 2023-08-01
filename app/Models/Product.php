<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brend_id',
        'category_id',
        'photos',
        'icon',
        'name',
        'view',
        'engine',
        'capacity_uz',
        'capacity_ru',
        'capacity_en',
        'reserve',
        'unit_uz',
        'unit_ru',
        'unit_en',
        'price_uz',
        'price_ru',
        'price_en',
        'slug',
        'ok',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function brends()
    {
        return $this->belongsTo(Brend::class, 'brend_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function charactrics()
    {
        return $this->hasMany(Charactric::class, 'product_id');
    }

    public function datas()
    {
        return $this->hasMany(Data::class, 'product_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'product_id');
    }
}
