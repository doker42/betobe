<?php


use App\Http\Controllers\Api\V1\SubmissionController;
use Illuminate\Support\Facades\Route;


Route::controller(SubmissionController::class)->group(function () {
    Route::post('/submit', 'store');
});
