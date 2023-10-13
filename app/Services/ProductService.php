<?php

namespace App\Services;

use App\Http\Controllers\Dashboard\CharactricController;
use App\Http\Controllers\Dashboard\DataController;
use App\Models\Charactric;
use App\Models\Data;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    public static function getProduct(int $id)
    {
        try {
            return Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public static function getProductsByBrandId(int $brandId)
    {
        try {
            return Product::where('brend_id', $brandId)->get();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function store($request)
    {

        try {
            if (!empty($request['photos'])) {
                $photos = [];
                foreach ($request['photos'] as $photo) {
                    array_push($photos, $this->saveImage($photo, 'image/product'));
                }
                $request['photos'] = $photos;
            }
            if (!empty($request['icon'])) {
                $request['icon'] = $this->saveImage($request['icon'], 'image/product');
            }
            if (!empty($request['ok'])) {
                $request['ok'] = 1;
            }
            if (!empty($request['name'])) {

                $request['slug'] = str_replace(' ', '_', strtolower($request['name'])) . '-' . Str::random(5);
            }

            $product = Product::create($request);
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
