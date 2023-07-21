<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Brend;
use App\Models\Category;
use App\Models\Charactric;
use App\Models\Data;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    private $dataController;
    private $charactricController;
    public function __construct(DataController $dataController, CharactricController $charactricController)
    {
        $this->dataController = $dataController;
        $this->charactricController = $charactricController;
    }

    public function index()
    {
        $products = Product::with(['categories', 'brends'])->orderBy('id', 'desc')->get();
        return view('dashboard.product.index', [
            'products'=>$products,
        ]);
    }

    public function create()
    {
        $brends = Brend::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        return view('dashboard.product.create', [
            'brends'=>$brends,
            'products'=>$products,
            'categories'=>$categories,
        ]);
    }

    
    public function store(StoreRequest $request)
    {
        // dd($request->all());
        $result = (new ProductService())->store($request->validated());
        if($result['status']){
            return redirect()->route('dashboard.product.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.product.index')->with('error', $result['message']);
    }

    public function show($id)
    {
        //
    }

    public function edit($slug)
    {
        $brends = Brend::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $product = Product::where('slug', $slug)->first();
        return view('dashboard.product.edit', [
            'product'=>$product,
            'brends'=>$brends,
            'categories'=>$categories,
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = (new ProductService())->update($request->validated(), $id);
        if($result['status']){
            return redirect()->route('dashboard.product.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.product.index')->with('error', $result['message']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        foreach (Data::where('product_id', $id)->get() as $data) {
            $this->dataController->destroy($data->id);
        }
        foreach (Charactric::where('product_id', $id)->get() as $charactric) {
            $this->charactricController->destroy($charactric->id);
        }
        foreach ($product->photos as $photo) {
            $this->fileDelete(null, null, $photo);
        }
        $this->fileDelete('\Product', $id, 'icon');
        $product->delete();

        return back()->with('success', 'Data deleted.');
    }
}
