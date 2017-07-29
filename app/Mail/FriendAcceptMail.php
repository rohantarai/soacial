<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendAcceptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name)
    {
        $this->fullname = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email,$this->fullname)
            ->subject('Request Accepted on SOAcial')
            ->view('emails.friendAccept')
            ->with(['fullname' => $this->fullname]);
    }
}
