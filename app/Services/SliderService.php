<?php

namespace App\Services;

use App\Models\Slider;
use Exception;

class SliderService extends BaseService
{
    /**
     * Store a new Slider record with an uploaded image.
     *
     * @param array $requestData The validated request data.
     *
     * @throws Exception If there is an error during image saving or Slider creation.
     */
    public function store(array $requestData)
    {
        try {
            if (isset($requestData['photo'])) {
                // Get the file extension from the uploaded photo and store it in the 'type' field.
                $requestData['type'] = $requestData['photo']->getClientOriginalExtension();
            }

            // Save the uploaded image and update the request data with the saved path.
            $requestData['photo'] = $this->saveImage($requestData['photo'], 'image/slider');

            // Create a new Slider record in the database.
            Slider::create($requestData);
        } catch (Exception $e) {
            // Log or handle the exception as needed.
            throw new Exception("Failed to store Slider: " . $e->getMessage());
        }
    }

    public function update($request, $id, $photo_type)
    {
        try {
            if (!empty($request['photo'])) {
                $this->fileDelete('\Slider', $id, 'photo');
                $request['photo'] = $this->fileSave($request['photo'], 'image/slider');
            }
            if (!empty($request['photo'])) {
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
