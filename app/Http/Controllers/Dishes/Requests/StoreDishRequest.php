<?php

namespace App\Http\Controllers\Dishes\Requests;

use App\Services\Dishes\DTO\StoreDishDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id'
        ];
    }

    public function getDTO(): StoreDishDTO
    {
        return StoreDishDTO::fromArray([
            'name' => $this->validated('name'),
            'description' => $this->validated('description'),
            'price' => $this->validated('price'),
            'category_id' => $this->validated('category_id'),
        ]);
    }
}
