<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\FileTrait;

class BaseController extends Controller
{
    use FileTrait;
    
    public function __construct()
    {
        $this->middleware('auth');
    }
}
