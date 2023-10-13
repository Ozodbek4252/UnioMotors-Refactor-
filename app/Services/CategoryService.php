<?php

namespace App\Services;

use App\Models\Category;

class CategoryService extends BaseService
{
    public function store($request)
    {
        try {
            if (!empty($request['photo'])) {
                $request['photo'] = $this->saveImage($request['photo'], 'image/category');
            }
            $category = Category::create($request);
            if ($category) {
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
            if (!empty($request['photo'])) {
                $this->fileDelete('\Category', $id, 'photo');
                $request['photo'] = $this->saveImage($request['photo'], 'image/category');
            }
            $category = Category::find($id)->update($request);
            if ($category) {
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
