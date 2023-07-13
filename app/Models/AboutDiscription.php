<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutDiscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'discription_uz',
        'discription_ru',
        'discription_en',
    ];
}
