<?php

namespace App\Jobs;

use App\Mail\ConformationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AddUserInBudgetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user,
        private int $budget_id,
        private string $token)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Mail::to($this->user->email)->send(new ConformationMail($this->user, $this->budget_id, $this->token));
    }
}
