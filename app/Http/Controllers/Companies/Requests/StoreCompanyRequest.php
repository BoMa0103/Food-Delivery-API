<?php

namespace App\Http\Controllers\Companies\Requests;

use App\Services\Companies\DTO\StoreCompanyDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'rating' => 'required|numeric',
            'status' => 'required|integer',
            'description' => 'required|string',
        ];
    }

    public function getDTO(): StoreCompanyDTO
    {
        return StoreCompanyDTO::fromArray([
            'name' => $this->validated('name'),
            'address' => $this->validated('address'),
            'rating' => $this->validated('rating'),
            'status' => $this->validated('status'),
            'description' => $this->validated('description'),
        ]);
    }
}
