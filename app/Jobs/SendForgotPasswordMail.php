<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class SendForgotPasswordMail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $plainPassword;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$plainPassword)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send(new ForgotPasswordMail($this->email,$this->plainPassword));
    }
}
