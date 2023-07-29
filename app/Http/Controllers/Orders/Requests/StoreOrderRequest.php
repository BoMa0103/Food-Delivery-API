<?php

namespace App\Http\Controllers\Orders\Requests;

use App\Services\Orders\DTO\StoreOrderRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Nette\Utils\Random;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_id' => 'required|integer|exists:companies,id',
            'cart_items' => 'required|json',
            'user_id' => 'required|integer|exists:users,id',
            'deliveryType' => 'required|integer',
            'deliveryTime' => 'required|integer',
            'deliveryAddressStreet' => 'required|string',
            'deliveryAddressHouse' => 'required|string',
        ];
    }

    public function getDTO(): StoreOrderRequestDTO
    {
        return StoreOrderRequestDTO::fromArray([
            'cart_items' => json_decode($this->validated('cart_items'), true),
            'company_id' => $this->validated('company_id'),
            'user_id' => $this->validated('user_id'),
            'deliveryType' => $this->validated('deliveryType'),
            'deliveryTime' => $this->validated('deliveryTime'),
            'deliveryAddressStreet' => $this->validated('deliveryAddressStreet'),
            'deliveryAddressHouse' => $this->validated('deliveryAddressHouse'),
        ]);
    }
}
