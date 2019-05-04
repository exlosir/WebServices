<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $siteName = "randomworkdomen.tk";
        return $this
                    ->from('info@randomworkdomen.tk', "Техническая поддержка сайта ". $siteName)
                    ->subject('Добро пожаловать на сайт ')
//                    ->cc('info@randomworkdomen.tk')
                    ->view('mails.email-confirmation');
    }
}
