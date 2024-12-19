<?php 
use App\Http\Controllers\Survey\AssessmentController;
use App\Http\Controllers\Dashboard\SurveyController;

// Dashboard Page
Route::get('/survey', [AssessmentController::class, 'index'])->name('survey.list');

Route::get('/survey/{id}', [AssessmentController::class, 'show'])->name('survey.show');

Route::post('/survey/{id}/submit', [SurveyController::class, 'submit'])->name('survey.submit');

