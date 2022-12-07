<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComputerResource extends JsonResource
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
            'title' => $this->title,
            'brand' => $this->brand,
            'description' => $this->description,
            'graphics_card' => $this->graphics_card,
            'processor' => $this->processor,
            'brand_id' => $this->brand->id,
            'brand_name' => $this->brand->name,
            'brand_description' => $this->brand->desrciption,
        ];
    }
}
