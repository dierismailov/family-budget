<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::query()->get('id');
        $budget_id = Budget::query()->get('id');
        $categories = ['Food', 'Sport', 'Health', 'Communal', 'Entertainment', 'Transport', 'Other'];
        $type = ['income', 'expense'];

        return [
            'user_id' => $user_id->random(),
            'budget_id' => $budget_id->random(),
            'amount' => $this->faker->numberBetween(100000, 10000000),
            'category' => $this->faker->randomElement($categories),
            'type' => $this->faker->randomElement($type),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now(),
        ];
    }
}
