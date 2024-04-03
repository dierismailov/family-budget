<?php

namespace App\DTO;


class UserDTO
{
    public function __construct(
        private string $name,
        private string $surname,
        private string $email,
        private string $password
    )
    {

    }

    public function getPassword(): string
    {
        return $this->password;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public static function fromArray($data): static
    {
        return new static(
            name: $data['name'],
            surname: $data['surname'],
            email: $data['email'],
            password: $data['password']
        );
    }


}
