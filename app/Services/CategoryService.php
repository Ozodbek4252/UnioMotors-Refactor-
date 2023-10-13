<?php

namespace App\Services;

use App\Models\Category;
use \Exception;

class CategoryService extends BaseService
{
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
