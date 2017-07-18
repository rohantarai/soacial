<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    public $email;
    public $subject;
    public $messages;
    public $ip;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($senderName,$senderEmail,$subject,$messages,$ip)
    {
        $this->fullname = $senderName;
        $this->email = $senderEmail;
        $this->subject = $subject;
        $this->messages = $messages;
        $this->ip = $ip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email,$this->fullname)
            ->subject($this->subject)
            ->view('emails.contactus')
            ->with(['fullname' => $this->fullname,
                'email' => $this->email,
                'subject' => $this->subject,
                'ip' => $this->ip,
            ]);
    }
}
