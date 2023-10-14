<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
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

    /**
     * Update a Category record.
     *
     * @param CategoryRequest $request The validated request data.
     * @param int $id The ID of the Category record to update.
     * @return RedirectResponse A redirect response with a success or error message.
     */
    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->update($request->validated(), $id);
            $message = 'Data updated successfully.';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->route('dashboard.category.index')->with('message', $message);
    }

    /**
     * Delete a category and its associated products.
     *
     * @param int $id The ID of the category to delete.
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return back()->with('success', 'Category deleted.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
