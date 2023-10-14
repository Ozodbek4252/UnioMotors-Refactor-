<?php

namespace App\Services;

use App\Models\Slider;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderService extends BaseService
{
    /**
     * Retrieve a Slider record by its ID.
     *
     * @param int $id The ID of the Slider record to retrieve.
     * @return Slider|null The found Slider record or null if not found.
     * @throws ModelNotFoundException If the Slider record is not found.
     */
    public static function getSlider(int $id): Slider|null
    {
        try {
            return Slider::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null; // Return null if the Slider record is not found.
        }
    }

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

    /**
     * Update a Slider record with new data and optional photo.
     *
     * @param array $requestData The validated request data.
     * @param int $id The ID of the Slider record to update.
     * @throws \Exception If an error occurs during the update.
     */
    public function update(array $requestData, int $id)
    {
        $slider = self::getSlider($id);

        try {
            if (isset($requestData['photo'])) {
                // Get the file extension from the uploaded photo and store it in the 'type' field.
                $requestData['type'] = $requestData['photo']->getClientOriginalExtension();

                $this->deleteFileByPath($slider->photo);
                $requestData['photo'] = $this->saveImage($requestData['photo'], 'image/slider');
            }

            $slider->update($requestData);
        } catch (Exception $e) {
            throw new Exception("Failed to update Slider: " . $e->getMessage());
        }
    }

    /**
     * Delete a slider and its associated photo.
     *
     * This method deletes a slider by its ID and ensures the associated photo is also removed.
     *
     * @param int $id The ID of the slider to delete.
     * @throws Exception If there is an error during deletion.
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            // Retrieve the slider by ID
            $slider = self::getSlider($id);

            if ($slider === null) {
                // Handle the case where the slider is not found (e.g., return an error response).
                return;
            }

            // Delete the slider's associated photo file
            $this->deleteFileByPath($slider->photo);

            // Delete the slider itself
            $slider->delete();
        } catch (Exception $e) {
            throw new Exception("Failed to delete slider: " . $e->getMessage());
        }
    }
}
