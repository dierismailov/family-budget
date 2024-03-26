<?php

namespace App\DTO;

class BudgetDTO
{
    public function __construct(
        private string $name,
        private string $status,
    )
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public static function fromArray($data): static
    {
        return new static(
            name: $data['name'],
            status: $data['status']
        );
    }
}
