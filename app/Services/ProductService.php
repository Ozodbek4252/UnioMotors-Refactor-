<?php

namespace App\Services;

use App\Http\Controllers\Dashboard\CharactricController;
use App\Http\Controllers\Dashboard\DataController;
use App\Models\Charactric;
use App\Models\Data;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class ProductService extends BaseService
{
    /**
     * Get a product by its ID.
     *
     * @param int $id The ID of the product to retrieve.
     *
     * @return Product|null The product object if found, or null if not found.
     */
    public static function getProduct(int $id): Product|null
    {
        try {
            return Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    /**
     * Get all products associated with a specific brand.
     *
     * @param int $brandId The ID of the brand.
     *
     * @return Collection|null A collection of products associated with the brand if found, or null if an error occurs.
     */
    public static function getProductsByBrandId(int $brandId): Collection|null
    {
        try {
            return Product::where('brand_id', $brandId)->get();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get all products associated with a specific category.
     *
     * @param int $categoryId The ID of the category.
     *
     * @return Collection|null A collection of products associated with the category if found, or null if an error occurs.
     */
    public static function getProductsByCategoryId(int $categoryId): Collection|null
    {
        try {
            return Product::where('category_id', $categoryId)->get();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Store a new product record.
     *
     * @param array $data The validated request data.
     *
     * @return array An array with 'status' and 'message' keys.
     */

    public function store(array $data): array
    {
        try {
            // Save product photos
            $data['photos'] = $this->saveProductImages($data['photos']);

            // Save product icon if provided
            $data['icon'] = $this->saveImage($data['icon'], 'image/product');

            // Set 'ok' to 1 if not empty
            if (!empty($data['ok'])) {
                $data['ok'] = 1;
            }

            // Generate a unique slug for the product
            $data['slug'] = $this->generateProductSlug($data['name']);

            // Create the product record
            $product = Product::create($data);

            if ($product) {
                return ['status' => true, 'message' => 'Data uploaded successfully.'];
            }

            return ['status' => false, 'message' => 'Not created!'];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Save product images and return an array of file paths.
     *
     * @param array $images An array of image data.
     *
     * @return array An array of file paths to the saved images.
     */
    private function saveProductImages(array $images): array
    {
        $savedImages = [];

        foreach ($images as $image) {
            $savedImages[] = $this->saveImage($image, 'image/product');
        }

        return $savedImages;
    }

    /**
     * Generate a unique slug for a product based on its name.
     *
     * @param string $productName The name of the product.
     *
     * @return string The generated product slug.
     */
    private function generateProductSlug(string $productName): string
    {
        $slug = str_replace(' ', '_', strtolower($productName)) . '-' . Str::random(5);
        // You may want to ensure the slug is unique here if necessary.
        return $slug;
    }

    public function update($request, $id)
    {
        try {
            $product = Product::find($id);;
            if (!empty($request['photos'])) {
                foreach ($product->photos as $photo) {
                    $this->fileDelete(null, null, $photo);
                    // dd('asd');
                }
                $photos = [];
                foreach ($request['photos'] as $photo) {
                    array_push($photos, $this->saveImage($photo, 'image/product'));
                }
                $request['photos'] = $photos;
            }
            if (!empty($request['icon'])) {
                $this->fileDelete('\Product', $id, 'icon');
                $request['icon'] = $this->saveImage($request['icon'], 'image/product');
            }
            if (!empty($request['ok'])) {
                $request['ok'] = 1;
            }

            if (empty($request['ok'])) {
                $request['ok'] = 0;
            }

            if (!empty($request['name'])) {

                $request['slug'] = str_replace(' ', '_', strtolower($request['name'])) . '-' . Str::random(5);
            }

            $product->update($request);
            if ($product) {
                return ['status' => true, 'message' => 'Data uploaded successfully.'];
            }
            return ['status' => false, 'message' => 'Not created!'];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function delete($id): void
    {
        $instance = new self(); // Create an instance of the class.
        $product = self::getProduct($id);

        foreach (Data::where('product_id', $id)->get() as $data) {
            $dataController = new DataController();
            $dataController->destroy($data->id);
        }

        foreach (Charactric::where('product_id', $id)->get() as $charactric) {
            $charactricController = new CharactricController();
            $charactricController->destroy($charactric->id);
        }

        foreach ($product->photos as $photo) {
            $instance->deleteFileByPath($photo);
        }

        $instance->deleteFileByPath($product->icon);

        $product->delete();
    }
}
