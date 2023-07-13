<?php

namespace App\Services;

use App\Models\Slider;

class SliderService extends BaseService

{
    public function store($request, $photo_type)
    {
        try {
            if (!empty($request['photo'])) {
                $request['photo'] = $this->fileSave($request['photo'], 'image/slider');
            }

            if (!empty($request['photo'])){
                $request['type'] = $photo_type;
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

    public function update($request, $id, $photo_type)
    {
        try {
            if (!empty($request['photo'])) {
                $this->fileDelete('\Slider', $id, 'photo');
                $request['photo'] = $this->fileSave($request['photo'], 'image/slider');
            }
            if (!empty($request['photo'])){
                $request['type'] = $photo_type->getClientOriginalExtension();
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
