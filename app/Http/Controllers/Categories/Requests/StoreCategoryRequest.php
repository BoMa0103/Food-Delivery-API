<?php

namespace App\Http\Controllers\Categories\Requests;

use App\Services\Categories\DTO\StoreCategoryDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'company_id' => 'required|integer',
        ];
    }

    public function getDTO(): StoreCategoryDTO
    {
        return StoreCategoryDTO::fromArray([
            'name' => $this->validated('name'),
            'company_id' => $this->validated('company_id'),
        ]);
    }
}
