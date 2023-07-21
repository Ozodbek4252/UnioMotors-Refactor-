<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    public function store($request)
    {
        
        try {
            if (!empty($request['photos'])) {
                $photos = [];
                foreach ($request['photos'] as $photo) {
                    array_push($photos, $this->photoSave($photo, 'image/product'));
                }
                $request['photos'] = $photos;
            }
            if (!empty($request['icon'])) {
                $request['icon'] = $this->photoSave($request['icon'], 'image/product');
            }
            if (!empty($request['ok'])){
                $request['ok'] = 1;
            }
            if (!empty($request['name'])){
                
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
                        array_push($photos, $this->photoSave($photo, 'image/product'));
                    }
                    $request['photos'] = $photos;
                }
                if (!empty($request['icon'])) {
                    $this->fileDelete('\Product', $id, 'icon');
                    $request['icon'] = $this->photoSave($request['icon'], 'image/product');
                }
                if (!empty($request['ok'])){
                    $request['ok'] = 1;
                }

                if (empty($request['ok'])){
                    $request['ok'] = 0;
                }

                if (!empty($request['name'])){
                    
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
}