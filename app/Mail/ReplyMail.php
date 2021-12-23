<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ReplyMail extends Mailable
{
    public function __construct()
    {

    }

    public function build()
    {
        return $this->view('emails.reply');
    }
}
