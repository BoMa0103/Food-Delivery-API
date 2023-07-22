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
            'company_id' => 'required|integer',
            'cart_items' => 'required|string',
        ];
    }

    public function getDTO(): StoreOrderDTO
    {
        return StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'company_id' => $this->validated('company_id'),
            'cart_items' => $this->validated('cart_items'),
        ]);
    }
}
