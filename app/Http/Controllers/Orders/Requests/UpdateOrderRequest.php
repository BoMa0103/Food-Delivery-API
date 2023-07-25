<?php

namespace App\Http\Controllers\Orders\Requests;

use App\Services\Orders\DTO\UpdateOrderDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cart_items' => 'required|string',
            'company_id' => 'required|integer',
            'user_id' => 'required|integer',
            'deliveryType' => 'required|integer',
            'deliveryTime' => 'required|integer',
        ];
    }

    public function getDTO(): UpdateOrderDTO
    {
        return UpdateOrderDTO::fromArray([
            'cart_items' => $this->validated('cart_items'),
            'company_id' => $this->validated('company_id'),
            'user_id' => $this->validated('user_id'),
            'deliveryType' => $this->validated('deliveryType'),
            'deliveryTime' => $this->validated('deliveryTime'),
        ]);
    }
}
