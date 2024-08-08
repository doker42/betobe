<?php

namespace App\Models;

use App\Events\SubmissionSavedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * @property string $name
 * @property string $email
 * @property string $message
 */
class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message'
    ];

    public static function createOne(array $submissionData)
    {
        try {

            $submission = Submission::create($submissionData);

            if ($submission) {

                event(new SubmissionSavedEvent($submission));
                return;
            }

        } catch (\Exception $e) {

            Log::info('Submission error: ' . $e->getMessage());

        }

        // I used simple mail-notification

        $name  = $submissionData['name'];
        $email = $submissionData['email'];
        $body  = $name . ', your submission have not been saved.';
        $subject = 'Your submissions';

        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });

    }
}
