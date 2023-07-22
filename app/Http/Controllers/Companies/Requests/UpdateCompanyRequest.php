<?php

namespace App\Http\Controllers\Companies\Requests;

use App\Services\Companies\DTO\UpdateCompanyDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'address' => 'string',
            'rating' => 'numeric',
            'status' => 'integer',
            'description' => 'string',
        ];
    }

    public function getDTO(): UpdateCompanyDTO
    {
        return UpdateCompanyDTO::fromArray([
            'name' => $this->validated('name'),
            'address' => $this->validated('address'),
            'rating' => $this->validated('rating'),
            'status' => $this->validated('status'),
            'description' => $this->validated('description'),
        ]);
    }
}
