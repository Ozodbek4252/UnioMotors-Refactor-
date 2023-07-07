<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Brend;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('brends')->orderBy('id', 'desc')->get();
        $brends = Brend::orderBy('id', 'desc')->get();
        return view('dashboard.category.crud', [
            'categories'=>$categories,
            'brends'=>$brends,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $result = (new CategoryService())->store($request->validated());
        if($result['status']){
            return redirect()->route('dashboard.category.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.category.index')->with('error', $result['message']);
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = (new CategoryService())->update($request->validated(), $id);
        if($result['status']){
            return redirect()->route('dashboard.category.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.category.index')->with('error', $result['message']);
    }

    public function destroy($id)
    {
        //
    }
}
