<?php

namespace App\Http\Resources\About;

use Illuminate\Http\Resources\Json\JsonResource;

class AllResource extends JsonResource
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
            'name_uz'=>$this->name_uz,
            'name_ru'=>$this->name_ru,
            'name_en'=>$this->name_en,
            'data_uz'=>$this->data_uz,
            'data_ru'=>$this->data_ru,
            'data_en'=>$this->data_en,
        ];
    }
}
