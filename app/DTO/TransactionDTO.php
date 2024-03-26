<?php

namespace App\DTO;

class TransactionDTO
{
    public function __construct(
        private int $user_id,
        private int $budget_id,
        private int $amount,
        private string $category,
        private string $type,
    )
    {

    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getBudgetId(): int
    {
        return $this->budget_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public static function fromArray($data): static
    {
        return new static(
            user_id: $data['user_id'],
            budget_id: $data['budget_id'],
            amount: $data['amount'],
            category: $data['category'],
            type: $data['type']
        );
    }
}
