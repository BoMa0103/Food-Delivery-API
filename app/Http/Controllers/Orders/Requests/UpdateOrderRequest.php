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
        ];
    }

    public function getDTO(): UpdateOrderDTO
    {
        return UpdateOrderDTO::fromArray([
            'cart_items' => $this->validated('cart_items'),
            'company_id' => $this->validated('company_id'),
        ]);
    }
}
