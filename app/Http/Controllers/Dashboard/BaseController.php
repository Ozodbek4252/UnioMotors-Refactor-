<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Traits\DestroyTrait;
use App\Traits\FileTrait;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
