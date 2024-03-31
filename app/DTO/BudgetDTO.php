<?php

namespace App\DTO;

class BudgetDTO
{
    public function __construct(
        private string $name,
        private string $status,
        private int    $limit
    )
    {

    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public static function fromArray($data): static
    {
        return new static(
            name: $data['name'],
            status: $data['status'],
            limit: $data['limit']
        );
    }
}
