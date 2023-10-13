<?php

namespace App\Services;

use App\Models\Brend;

class BrendService extends BaseService
{
    /**
     * Store a new Brend record with uploaded image.
     *
     * @param array $requestData The validated request data.
     * @throws \Exception If there is an error during the image saving or Brend creation.
     */
    public function store(array $requestData)
    {
        try {
            // Save the uploaded image and update the request data with the saved path.
            $requestData['photo'] = $this->saveImage($requestData['photo'], 'image/brend');

            // Create a new Brend record in the database.
            Brend::create($requestData);
        } catch (\Exception $e) {
            // Log or handle the exception as needed.
            throw new \Exception("Failed to store Brend: " . $e->getMessage());
        }
    }

    public function update($request, $id)
    {
        try {
            if (!empty($request['photo'])) {
                $this->fileDelete('\Brend', $id, 'photo');
                $request['photo'] = $this->saveImage($request['photo'], 'image/brend');
            }
            $brend = Brend::find($id)->update($request);
            if ($brend) {
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
