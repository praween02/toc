<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registration, $password)
    {
        $this->registration = $registration;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Bharat 5G Labs')
                    ->view('emails.welcome');
    }
} 