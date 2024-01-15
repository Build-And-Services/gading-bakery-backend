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
            'user_id' => $this->user_id,
            'total_pembelian' => $this->calculateTotalOrderPrice(),
            'order_items' => $this->orderItems,
        ];
    }

    private function calculateTotalOrderPrice()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->products->selling_price;
        });
    }


}
