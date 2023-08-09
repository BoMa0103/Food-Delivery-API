<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'cart_items' => $this->cart_items,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'deliveryType' => $this->deliveryType,
            'deliveryTime' => $this->deliveryTime,
            'deliveryAddressStreet' => $this->deliveryAddressStreet,
            'deliveryAddressHouse' => $this->deliveryAddressHouse,
        ];
    }
}
