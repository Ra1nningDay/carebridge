<?php 
use App\Http\Controllers\Survey\AssessmentController;
use App\Http\Controllers\Dashboard\SurveyController;
use App\Http\Controllers\Survey\HealthAssessmentController;
use App\Http\Controllers\Survey\HypertensionSurveyController;
use App\Http\Controllers\Survey\HearingSurveyController;
use App\Http\Controllers\Survey\OralHealthSurveyController;
use App\Http\Controllers\Survey\VisionSurveyController;

// Survey Management
Route::get('/survey', function () {
    return view('surveys.index');
})->name('survey.index');

Route::prefix('survey')->group(function () {
    
    Route::get('/health_assessment', [HealthAssessmentController::class, 'create'])->name('health_assessments.create');
    Route::post('/health_assessment', [HealthAssessmentController::class, 'store'])->name('health_assessments.store');
    Route::get('/health_assessment/{healthAssessment}', [HealthAssessmentController::class, 'show'])->name('health_assessments.show');

    Route::get('/hypertension', [HypertensionSurveyController::class, 'index'])->name('hypertension.survey.index');
    Route::post('/hypertension', [HypertensionSurveyController::class, 'store'])->name('hypertension.survey.store');

    Route::get('/hearing', [HearingSurveyController::class, 'index'])->name('hearing.survey.index');
    Route::post('/hearing', [HearingSurveyController::class, 'store'])->name('hearing.survey.store');

    Route::get('/oral-health', [OralHealthSurveyController::class, 'index'])->name('oral-health.survey.index');
    Route::post('/oral-health', [OralHealthSurveyController::class, 'store'])->name('oral-health.survey.store');

    Route::get('/vision', [VisionSurveyController::class, 'index'])->name('vision.survey.index');
    Route::post('/vision', [VisionSurveyController::class, 'store'])->name('vision.survey.store');
});
