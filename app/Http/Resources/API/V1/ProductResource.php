<?php

namespace App\Http\Resources\API\V1;

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
            "sku" => $this->sku,
            "name" => $this->name,
            "category" => $this->category,
            "price" => [
                "original" => $this->original_price,
                "final" => $this->final_price,
                "discount_percentage" => $this->discount_percentage,
                "currency" => "EUR"
            ],
        ];
    }
}
