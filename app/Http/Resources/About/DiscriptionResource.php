<?php

namespace App\Http\Resources\About;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscriptionResource extends JsonResource
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
            'discription_uz'=>$this->discription_uz,
            'discription_ru'=>$this->discription_ru,
            'discription_en'=>$this->discription_en,
        ];
    }
}
