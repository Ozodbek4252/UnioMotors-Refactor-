<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            'discription_uz'=>$this->discription_uz,
            'discription_ru'=>$this->discription_ru,
            'discription_en'=>$this->discription_en,
        ];
    }
}
