<?php

namespace App\Http\Controllers\Packages\Requests;

use App\Services\Packages\DTO\UpdatePackageDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }

    public function getDTO(): UpdatePackageDTO
    {
        return UpdatePackageDTO::fromArray([
            'name' => $this->validated('name'),
            'price' => $this->validated('price'),
            'description' => $this->validated('description'),
            'company_id' => $this->validated('company_id'),
        ]);
    }
}
