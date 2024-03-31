<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\BudgetUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BudgetUser>
 */
class BudgetUserFactory extends Factory
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
        return [
            'user_id' => $user_id->random(),
            'budget_id' => $budget_id->random()
        ];
    }
}
