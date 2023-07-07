<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    public function brends()
    {
        return $this->belongsTo(Brend::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
