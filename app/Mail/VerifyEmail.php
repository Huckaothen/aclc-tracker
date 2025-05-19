<?php

namespace App\Mail;

use App\Models\Alumni;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $alumni;
    public $verificationLink;

    public function __construct(Alumni $alumni, $verificationLink)
    {
        $this->alumni = $alumni;
        $this->verificationLink = $verificationLink;
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address')
                    ->view('emails.verify_email')
                    ->with([
                        'alumni' => $this->alumni,
                        'verificationLink' => $this->verificationLink,
                    ]);
    }
}
