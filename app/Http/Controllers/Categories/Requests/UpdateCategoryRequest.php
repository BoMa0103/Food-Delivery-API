<?php

namespace App\Http\Controllers\Categories\Requests;

use App\Services\Categories\DTO\UpdateCategoryDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'company_id' => 'integer',
        ];
    }

    public function getDTO(): UpdateCategoryDTO
    {
        return UpdateCategoryDTO::fromArray([
            'name' => $this->validated('name'),
            'company_id' => $this->validated('company_id'),
        ]);
    }
}
