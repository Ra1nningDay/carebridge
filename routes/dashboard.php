<?php 

use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\EvaluationController;
use App\Http\Controllers\Dashboard\SurveyController;
use App\Http\Controllers\Dashboard\RatingController; // Import RatingController

// Admin Dashboard Routes
Route::prefix('dashboard')->middleware(['auth', 'verified', AdminOnly::class])->group(function () {
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/public-infomation', [PostController::class, 'dashboard'])->name('dashboard.public-information');

    // Caregiver Management
    Route::get('/caregiver-management', [CaregiverController::class, 'index'])->name('dashboard.caregiver-management');
    Route::patch('/caregivers/{id}/update-status', [CaregiverController::class, 'updateStatus'])->name('caregivers.updateStatus');

    // User Management
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('dashboard.user-management');
    Route::patch('/user-management/{id}', [UserManagementController::class, 'update'])->name('dashboard.user-management.update');

    // Evaluation Management
    Route::prefix('evaluations')->name('evaluations.')->group(function () {
        Route::get('/', [EvaluationController::class, 'index'])->name('index');
        Route::post('/', [EvaluationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EvaluationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EvaluationController::class, 'update'])->name('update');
        Route::delete('/{evaluationTopic}', [EvaluationController::class, 'destroy'])->name('destroy');
    });

    // Rating Management (ใหม่)
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');

    // Survey Management
    Route::prefix('survey')->name('survey.')->group(function () {
        // แสดงหัวข้อแบบประเมินทั้งหมด
        Route::get('/survey', [SurveyController::class, 'index'])->name('index');

        // เพิ่มหัวข้อใหม่
        Route::post('/store', [SurveyController::class, 'store'])->name('store');

        // แสดงคำถามในหัวข้อ
        Route::get('/{id}/questions', [SurveyController::class, 'questions'])->name('questions');

        // เพิ่มคำถามใหม่ในหัวข้อ
        Route::post('/{id}/questions/store', [SurveyController::class, 'storeQuestion'])->name('questions.store');

        // แก้ไขคำถาม
        Route::get('/questions/{question}/edit', [SurveyController::class, 'editQuestion'])->name('questions.edit');

        // อัปเดตคำถาม
        Route::put('/questions/{question}', [SurveyController::class, 'updateQuestion'])->name('questions.update');

        // ลบคำถาม
        Route::delete('/questions/{question}', [SurveyController::class, 'destroyQuestion'])->name('questions.destroy');
    });

    

});
