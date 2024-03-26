<?php

namespace Database\Seeders;

use App\Models\BudgetMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         BudgetMember::factory()
             ->count(100)
             ->create();
    }
}
