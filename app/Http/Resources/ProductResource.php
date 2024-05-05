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
        $categoryName = optional($this->category)->name;

        $increaseQuantity = $this->getTotalIncreaseQuantity();
        $decreaseQuantity = $this->getTotalDecreaseQuantity();
        $totalQuantity = $increaseQuantity - $decreaseQuantity;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'product_code' => $this->product_code,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'category' => $categoryName,
            'quantity' => $totalQuantity
        ];
    }
}
