<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\BaseController;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lang = 'ru';
        return $this->successResponse('success', SliderResource::collection(Slider::orderBy('id', 'desc')->get()));
        
    }

}
