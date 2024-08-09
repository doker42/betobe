<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SubmissionNotSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // I used simple mail-notification

        $name  = $event->submissionData['name'];
        $email = $event->submissionData['email'];
        $body  = $name . ', your submission have not been saved.';
        $subject = 'Your submissions';

        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });
    }
}
