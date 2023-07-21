<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'photos'=> $this->when($this->photos, function(){
                foreach($this->photos as $photo){
                    $photos[] = env('APP_URL') . $photo;
                }
                return $photos;
            }),
            'icon'=> env('APP_URL').$this->icon,
            'brend_id'=> $this->brend_id,
            'category_id'=> $this->category_id,
            'name'=>$this->name,
            'engine'=>$this->engine,
            'capacity_uz'=>$this->capacity_uz,
            'capacity_ru'=>$this->capacity_ru,
            'capacity_en'=>$this->capacity_en,
            'reserve'=>$this->reserve,
            'unit_uz'=>$this->unit_uz,
            'unit_ru'=>$this->unit_ru,
            'unit_en'=>$this->unit_en,
            'price_uz'=>$this->price_uz,
            'price_ru'=>$this->price_ru,
            'price_en'=>$this->price_en,
            'slug'=>$this->slug,
            'ok'=>$this->ok,
            'discription_uz'=>$this->discription_uz,
            'discription_ru'=>$this->discription_ru,
            'discription_en'=>$this->discription_en,
            'link'=>$this->link,
        ];
    }
}
