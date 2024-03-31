<?php

namespace App\Jobs;

use App\Models\Budget;
use App\Models\BudgetUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateRecordInBudgetMemberTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id, private Budget $budget)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $newRecord = new BudgetUser();
        $newRecord->user_id = $this->user_id;
        $newRecord->budget_id = $this->budget->id;
        $newRecord->save();
    }
}
