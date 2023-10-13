<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use \Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends BaseController
{
    /**
     * Create a new instance of CategoryService.
     *
     * @param CategoryService $service The CategoryService instance.
     */
    public function __construct(private CategoryService $service)
    {
    }

    /**
     * Display a list of Categories in descending order by ID.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('dashboard.category.crud', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a new Category record.
     *
     * @param CategoryRequest $request The validated request data.
     * @return RedirectResponse A redirect response.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            $this->service->store($request->validated());

            return redirect()->route('dashboard.category.index')
                ->with('success', 'Category uploaded successfully.');
        } catch (Exception $e) {
            return redirect()->route('dashboard.category.index')
                ->with('error', $e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = (new CategoryService())->update($request->validated(), $id);
        if ($result['status']) {
            return redirect()->route('dashboard.category.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.category.index')->with('error', $result['message']);
    }

    public function destroy($id)
    {
        $this->fileDelete('\Category', $id, 'photo');
        Category::find($id)->delete();
        foreach (Product::where('category_id', $id)->get() as $prod) {
            $this->productController->destroy($prod->id);
        }
        return back()->with('success', 'Data deleted.');
    }
}
