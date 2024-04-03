<?php

namespace App\Jobs;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SumTransactionLimitBudgetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
       private  Transaction $transaction
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->transaction->type === 'expense'){

           $budget_id = $this->transaction->budget_id;


           $amounts = Transaction::query()->where('budget_id', $budget_id)->get('amount');
            $totalAmount = $amounts->sum('amount');

            /**  @var Budget|null $budget */
            $budget = Budget::query()->find($budget_id);

            if ($totalAmount > $budget->limit){
                $budget->status = 'not stable';
                $budget->save();
            }

        }
    }
}
