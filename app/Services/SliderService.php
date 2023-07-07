<?php

namespace App\Services;

use App\Models\Slider;

class SliderService extends BaseService

{
    public function store($request)
    {
        try {
            if (!empty($request['photo'])) {
                $request['photo'] = $this->photoSave($request['photo'], 'image/slider');
            }
            $slider = Slider::create($request);
            if ($slider) {
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
                $this->fileDelete('\Slider', $id, 'photo');
                $request['photo'] = $this->photoSave($request['photo'], 'image/slider');
            }
            $slider = Slider::find($id)->update($request);
            if ($slider) {
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
