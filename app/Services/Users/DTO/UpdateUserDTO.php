<?php

namespace App\Services\Users\DTO;

class UpdateUserDTO
{
    public function __construct(
        protected string $name,
        protected string $email,
        protected mixed  $password,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): mixed
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }

    public static function fromArray(array $data): UpdateUserDTO
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'],
        );
    }
}
