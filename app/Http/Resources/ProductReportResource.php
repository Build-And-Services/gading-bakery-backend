<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReportResource extends JsonResource
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
            'product' => $this->products_name,
            'profit' => ($this->selling_price - $this->purchase_price) * $this->total_quantity,
            'revenue' => $this->selling_price * $this->total_quantity,
            'quantity' => $this->total_quantity,
        ];
    }
}
