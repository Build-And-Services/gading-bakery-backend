<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
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
            'cashier' => $this->user->name,
            'nominal' => $this->nominal,
            'total_price' => $this->calculateTotalOrderPrice(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'change' => $this->nominal - $this->calculateTotalOrderPrice(),
            'details' => $this->orderItems()
                ->get()
                ->map(function ($query) {
                    return [
                        "quantity" => $query->quantity,
                        "products_name" => $query->product_name,
                        "product_image" => $query->product_image,
                        "selling_price" => $query->selling_price,
                        "category_name" => $query->category_name
                    ];
                }),
        ];
    }
}
