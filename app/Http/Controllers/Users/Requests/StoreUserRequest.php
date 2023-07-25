<?php

namespace App\Http\Controllers\Users\Requests;

use App\Services\Users\DTO\StoreUserDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function getDTO(): StoreUserDTO
    {
        return StoreUserDTO::fromArray([
            'name' => $this->validated('name'),
            'email' => $this->validated('email'),
            'password' => $this->validated('password'),
        ]);
    }
}
