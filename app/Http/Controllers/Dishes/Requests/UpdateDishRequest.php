<?php

namespace App\Http\Controllers\Dishes\Requests;

use App\Services\Dishes\DTO\UpdateDishDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'file|mimes:jpg,png,jpeg|max:5048',
            'category_id' => 'required|integer|exists:categories,id',
            'package_id' => 'required|integer|exists:packages,id'
        ];
    }

    public function getDTO(): UpdateDishDTO
    {
        return UpdateDishDTO::fromArray([
            'name' => $this->validated('name'),
            'description' => $this->validated('description'),
            'price' => $this->validated('price'),
            'image' => $this->validated('image'),
            'category_id' => $this->validated('category_id'),
            'package_id' => $this->validated('package_id'),
        ]);
    }
}
