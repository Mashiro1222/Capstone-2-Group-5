<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user; // Pass the user object
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account Created Successfully')
                    ->view('emails.account_created')
                    ->with([
                        'name' => $this->user->name,   // Pass the user's name
                        'email' => $this->user->email // Pass the user's email
                    ]);
    }
}
