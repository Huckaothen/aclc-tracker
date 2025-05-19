<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\AlumniJob;

class JobStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $job;

    public function __construct(AlumniJob $job)
    {
        $this->job = $job;
    }

    public function build()
    {
        return $this->subject('Job Status Update Notification')
                    ->view('emails.job_status_updated')
                    ->with(['job' => $this->job]);
    }
}
