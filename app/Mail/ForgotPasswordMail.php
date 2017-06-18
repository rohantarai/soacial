<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $plainPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$plainPassword)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dont-reply@soacial.com','SOACIAL')
            ->subject('Account Password')
            ->view('emails.accountPassword')
            ->to($this->email)
            ->with(['plainPassword' => $this->plainPassword]);
    }
}
