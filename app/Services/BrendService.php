<?php

namespace App\Services;

use App\Models\Brend;

class BrendService extends BaseService
{
    public function store($request)
    {
        try {
            if (!empty($request['photo'])) {
                $request['photo'] = $this->saveImage($request['photo'], 'image/brend');
            }
            $brend = Brend::create($request);
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
