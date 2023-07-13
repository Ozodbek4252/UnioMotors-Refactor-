<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharactricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'photo'=> env('APP_URL').$this->photo,
            'name_uz'=>$this->name_uz,
            'name_ru'=>$this->name_ru,
            'name_en'=>$this->name_en,
            'data_uz'=>$this->data_uz,
            'data_ru'=>$this->data_ru,
            'data_en'=>$this->data_en,
        ];
    }
}
