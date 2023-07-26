<?php

namespace App\Http\Controllers\Orders\Requests;

use App\Services\Orders\DTO\StoreOrderDTO;
use Illuminate\Foundation\Http\FormRequest;
use Nette\Utils\Random;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_id' => 'required|integer|exists:companies,id',
            'cart_items' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'deliveryType' => 'required|integer',
            'deliveryTime' => 'required|integer',
            'deliveryAddressStreet' => 'required|string',
            'deliveryAddressHouse' => 'required|string',
        ];
    }

    public function getDTO(): StoreOrderDTO
    {
        return StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'company_id' => $this->validated('company_id'),
            'cart_items' => $this->validated('cart_items'),
            'user_id' => $this->validated('user_id'),
            'deliveryType' => $this->validated('deliveryType'),
            'deliveryTime' => $this->validated('deliveryTime'),
            'deliveryAddressStreet' => $this->validated('deliveryAddressStreet'),
            'deliveryAddressHouse' => $this->validated('deliveryAddressHouse'),
        ]);
    }
}
