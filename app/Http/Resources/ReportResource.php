<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $priceTransaction = $this->calculateTotalOrderPrice();

        return [
            'total_transaction' => $this->calculateTotalOrder(),
            'price_transaction' => $this->calculateTotalOrderPrice(),
            // 'total_price_transaction' => array_sum($priceTransaction),
        ];
    }


    public function calculateTotalOrderPrice()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->products->selling_price;
        });
    }

    private function calculateTotalOrder()
    {
        return $this->sum('quantity');
    }

}
