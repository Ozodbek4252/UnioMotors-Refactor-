<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brend extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'brend_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brend_id');
    }
}
