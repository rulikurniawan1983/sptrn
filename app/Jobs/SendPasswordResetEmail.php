<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class SendPasswordResetEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = new Request(['email' => $this->email]);
        Password::sendResetLink($request->only('email'));
    }
}
