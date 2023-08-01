<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\BaseController;
use App\Http\Resources\FliterResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShowResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    
    public function index(Request $request)
    {
        $products = Product::when($request->get('brend_id'), function($q) use ($request){
            $q->where('brend_id', $request->get('brend_id'));
        })
        ->when($request->get('category_id'), function($q) use ($request){
            $q->where('category_id', $request->get('category_id'));
        })
        ->orderBy('id')
        ->get();

        return $this->successResponse('success', ProductResource::collection($products));
    }

    public function show($slug)
    {
        return $this->successResponse('success', ProductShowResource::make(Product::with(['charactrics', 'datas','categories'])->where('slug', $slug)->first()));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
