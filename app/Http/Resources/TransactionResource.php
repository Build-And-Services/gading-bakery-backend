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
            'product_length' => $this->orderItems()->count()
        ];
    }


}
