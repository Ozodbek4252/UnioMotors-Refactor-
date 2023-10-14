<?php

namespace App\Services;

use App\Http\Controllers\Dashboard\CharactricController;
use App\Http\Controllers\Dashboard\DataController;
use App\Http\Controllers\Dashboard\ProductController;
use \Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Brend;

class BrendService extends BaseService
{
    /**
     * Retrieve a Brand record by its ID.
     *
     * @param int $id The ID of the Brand record to retrieve.
     * @return Brend|null The found Brand record or null if not found.
     * @throws ModelNotFoundException If the Brand record is not found.
     */
    public static function getBrand(int $id): Brend|null
    {
        try {
            return Brend::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null; // Return null if the Brand record is not found.
        }
    }

    /**
     * Store a new Brand record with uploaded image.
     *
     * @param array $requestData The validated request data.
     * @throws Exception If there is an error during the image saving or Brand creation.
     */
    public function store(array $requestData)
    {
        try {
            // Save the uploaded image and update the request data with the saved path.
            $requestData['photo'] = $this->saveImage($requestData['photo'], 'image/brand');

            // Create a new Brand record in the database.
            Brend::create($requestData);
        } catch (Exception $e) {
            // Log or handle the exception as needed.
            throw new Exception("Failed to store Brand: " . $e->getMessage());
        }
    }

    /**
     * Update a Brand record with new data and optional photo.
     *
     * @param array $request The validated request data.
     * @param int $id The ID of the Brand record to update.
     * @throws \Exception If an error occurs during the update.
     */
    public function update(array $request, int $id)
    {
        $brand = self::getBrand($id);

        try {
            if (isset($request['photo'])) {
                $this->deleteFileByPath($brand->photo);
                $request['photo'] = $this->saveImage($request['photo'], 'image/brand');
            }

            $brand->update($request);
        } catch (Exception $e) {
            throw new Exception("Failed to update Brand: " . $e->getMessage());
        }
    }

    /**
     * Delete a brand and its associated products.
     *
     * @param int $id The ID of the brand to delete.
     * @return void
     */
    public function delete($id)
    {
        // Step 1: Retrieve the brand by ID
        $brand = self::getBrand($id);


        // Step 2: Delete the brand's associated photo file
        $this->deleteFileByPath($brand->photo);

        // Step 3: Delete all products associated with the brand
        $this->deleteBrandProducts($id);

        // Step 4: Delete the brand itself
        $brand->delete();
    }

    /**
     * Delete all products associated with a brand.
     *
     * @param int $brandId The ID of the brand.
     *
     * @return void
     */
    private function deleteBrandProducts($brandId)
    {
        $products = ProductService::getProductsByBrandId($brandId);

        if ($products) {
            foreach ($products as $product) {
                $productService = new ProductService();
                $productService->delete($product->id);
            }
        }
    }
}
