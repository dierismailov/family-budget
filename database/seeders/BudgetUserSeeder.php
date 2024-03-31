<?php

namespace Database\Seeders;

use App\Models\BudgetUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         BudgetUser::factory()
             ->count(100)
             ->create();
    }
}
