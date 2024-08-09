<?php

namespace App\Models;

use App\Events\SubmissionNotSavedEvent;
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


    /**
     *  Used pattern "Fat models"
     *
     * @param array $submissionData
     * @return void
     */
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

        event(new SubmissionNotSavedEvent($submissionData));
    }
}
