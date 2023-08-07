<?php

namespace App\Http\Controllers\Orders\Requests;

use App\Services\Orders\DTO\UpdateOrderRequestDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cart_items' => 'required|array',
            'cart_items.*.id' => 'required|integer|exists:dishes,id',
            'cart_items.*.count' => 'required|integer|max:100',
            'company_id' => 'required|integer|exists:companies,id',
            'user_id' => 'required|integer|exists:users,id',
            'deliveryType' => 'required|integer',
            'deliveryTime' => 'required|integer',
            'deliveryAddressStreet' => 'required|string',
            'deliveryAddressHouse' => 'required|string',
        ];
    }

    public function getDTO(): UpdateOrderRequestDTO
    {
        return UpdateOrderRequestDTO::fromArray([
            'cart_items' => $this->validated('cart_items'),
            'company_id' => $this->validated('company_id'),
            'user_id' => $this->validated('user_id'),
            'deliveryType' => $this->validated('deliveryType'),
            'deliveryTime' => $this->validated('deliveryTime'),
            'deliveryAddressStreet' => $this->validated('deliveryAddressStreet'),
            'deliveryAddressHouse' => $this->validated('deliveryAddressHouse'),
        ]);
    }
}
