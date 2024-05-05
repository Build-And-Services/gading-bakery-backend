<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStockResource extends JsonResource
{
     public function __construct($product, $stockHistory, $totalQuantity, $totalResidual)
    {
        $this->product = $product;
        $this->stockHistory = $stockHistory;
        $this->totalQuantity = $totalQuantity;
        $this->totalResidual = $totalResidual;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'product' =>  [
                    "id" => $this->product->id,
                    "name" => $this->product->name,
                    "image" => $this->product->image,
                    "product_code" => $this->product->product_code,
                    "purchase_price" => $this->product->purchase_price,
                    "selling_price" => $this->product->selling_price,
                    "category_id" => $this->product->category_id,
                    "created_at" => $this->product->created_at->format('Y-m-d H:i:s'),
                    "updated_at" => $this->product->updated_at->format('Y-m-d H:i:s')
            ],
            'stocks' => $this->stockHistory->map(function ($stock) {
                return [
                    "id" => $stock->id,
                    "quantity" => $stock->quantity,
                    "type" => $stock->type,
                    "product_id" => $stock->product_id,
                    "created_at" => $stock->created_at->format('Y-m-d H:i:s'),
                    "updated_at" => $stock->updated_at->format('Y-m-d H:i:s')
                ];
            }),
            "totalQuantity" => $this->totalQuantity,
            "totalResidual" => $this->totalResidual
        ];
    }
}
