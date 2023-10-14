<?php

namespace App\Services;

use App\Models\Category;
use \Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService extends BaseService
{
    /**
     * Retrieve a Category record by its ID.
     *
     * @param int $id The ID of the Category record to retrieve.
     * @return Category|null The found Category record or null if not found.
     * @throws ModelNotFoundException If the Category record is not found.
     */
    public static function getCategory(int $id): Category|null
    {
        try {
            return Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    /**
     * Store a new Category record.
     *
     * @param array $data The data to create the Category record.
     * @return void
     * @throws Exception If an error occurs during the operation.
     */
    public function store(array $data): void
    {
        try {
            if (!empty($data['photo'])) {
                $data['photo'] = $this->saveImage($data['photo'], 'image/category');
            }

            $category = Category::create($data);

            if (!$category) {
                throw new Exception('Category not created.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update a Category record with new data and optional photo.
     *
     * @param array $request The validated request data.
     * @param int $id The ID of the Category record to update.
     * @throws \Exception If an error occurs during the update.
     */
    public function update($request, $id)
    {
        $category = self::getCategory($id);

        try {
            if (isset($request['photo'])) {
                $this->deleteFileByPath($category->photo);
                $request['photo'] = $this->saveImage($request['photo'], 'image/category');
            }

            $category->update($request);
        } catch (Exception $e) {
            throw new Exception("Failed to update Category: " . $e->getMessage());
        }
    }

    /**
     * Delete a category and its associated products.
     *
     * @param int $id The ID of the category to delete.
     * @return void
     */
    public function delete($id): void
    {
        // Step 1: Retrieve the category by ID
        $category = self::getCategory($id);


        // Step 2: Delete the category's associated photo file
        $this->deleteFileByPath($category->photo);

        // Step 3: Delete all products associated with the category
        $this->deleteCategoryProducts($id);

        // Step 4: Delete the category itself
        $category->delete();
    }

    /**
     * Delete all products associated with a category.
     *
     * @param int $categoryId The ID of the category.
     *
     * @return void
     */
    private function deleteCategoryProducts($categoryId)
    {
        $products = ProductService::getProductsByCategoryId($categoryId);

        if ($products) {
            foreach ($products as $product) {
                $productService = new ProductService();
                $productService->delete($product->id);
            }
        }
    }
}
