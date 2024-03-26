<?php

namespace App\Jobs;

use App\Mail\CodeForRegister;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCodeForRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user
    )
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to("dierismailov9@gmail.com")->send(new CodeForRegister($this->user));
    }
}
