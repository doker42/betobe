<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubmissionSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // used very simple email notification

        $name  = $event->submission?->name;
        $email = $event->submission?->email;
        $body = $name . ', your submission have been successfully saved.';
        $subject = 'Your submissions';

        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });
    }
}
