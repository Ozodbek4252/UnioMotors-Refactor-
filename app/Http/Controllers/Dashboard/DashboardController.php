<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Brend;
class DashboardController extends BaseController
{
    public function index()
    {
        $products = Product::all();
        $view_count = 0;
        foreach($products as $product){
            $view_count += $product->view;
        }
        $category = Category::all();
        $fedback = Feedback::all();
        $brend = Brend::all();
        return view('dashboard.dashboard', [
            'product_view_count'=>$view_count,
            'products'=>$products,
            'category'=>$category,
            'fedback'=>$fedback,
            'brend'=>$brend,
        ]);
    }
}
