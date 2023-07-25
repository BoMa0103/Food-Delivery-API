<?php

namespace App\Http\Controllers\Users\Requests;

use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function getDTO(): UpdateUserDTO
    {
        return UpdateUserDTO::fromArray([
            'name' => $this->validated('name'),
            'email' => $this->validated('email'),
            'password' => $this->validated('password'),
        ]);
    }
}
