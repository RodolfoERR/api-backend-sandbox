<?php

namespace App\Jobs;

use App\Mail\AuthMail;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected User $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void{
        Mail::to($this->user->email)->send(new AuthMail($this->user));
    }
}
