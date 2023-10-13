<?php

namespace App\Services;

use \Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Brend;

class BrendService extends BaseService
{
    /**
     * Retrieve a Brend record by its ID.
     *
     * @param int $id The ID of the Brend record to retrieve.
     * @return Brend|null The found Brend record or null if not found.
     * @throws ModelNotFoundException If the Brend record is not found.
     */
    public static function getBrend(int $id)
    {
        try {
            return Brend::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null; // Return null if the Brend record is not found.
        }
    }

    /**
     * Store a new Brend record with uploaded image.
     *
     * @param array $requestData The validated request data.
     * @throws Exception If there is an error during the image saving or Brend creation.
     */
    public function store(array $requestData)
    {
        try {
            // Save the uploaded image and update the request data with the saved path.
            $requestData['photo'] = $this->saveImage($requestData['photo'], 'image/brend');

            // Create a new Brend record in the database.
            Brend::create($requestData);
        } catch (Exception $e) {
            // Log or handle the exception as needed.
            throw new Exception("Failed to store Brend: " . $e->getMessage());
        }
    }

    /**
     * Update a Brend record with new data and optional photo.
     *
     * @param array $request The validated request data.
     * @param int $id The ID of the Brend record to update.
     * @throws \Exception If an error occurs during the update.
     */
    public function update(array $request, int $id)
    {
        $brend = self::getBrend($id);

        try {
            if (isset($request['photo'])) {
                $this->deleteFileByPath($brend->photo);
                $request['photo'] = $this->saveImage($request['photo'], 'image/brend');
            }

            $brend->update($request);
        } catch (Exception $e) {
            throw new Exception("Failed to update Brend: " . $e->getMessage());
        }
    }
}
