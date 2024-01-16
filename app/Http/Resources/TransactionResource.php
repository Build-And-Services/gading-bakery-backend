<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'nominal' => $this->nominal,
            'user_id' => $this->user->name,
            'total_pembelian' => $this->calculateTotalOrderPrice(),
            'order_items' => $this->orderItems()
                ->get()
                ->map(function ($query) {
                    return [
                        "id" => $query->id,
                        "product_id" => $query->products->id,
                        "quantity" => $query->quantity,
                        "products_name" => $query->products->name,
                        "products_image" => $query->products->image,
                        "purchase_price" => $query->products->purchase_price,
                        "selling_price" => $query->products->selling_price,
                        'product_category' => $query->products->category->name,
                        "created_at" => $query->created_at,
                        "updated_at" => $query->updated_at,
                    ];
                }),
        ];
    }


}
