<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendRequestMail extends Mailable
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
            ->subject('Friend Requested on SOAcial')
            ->view('emails.friendRequest')
            ->with(['fullname' => $this->fullname]);
    }
}
