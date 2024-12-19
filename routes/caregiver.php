<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Caregiver;
use App\Http\Controllers\CaregiverController;

// เส้นทางสำหรับดูโปรไฟล์ผู้อื่น
Route::get('/profile/{id}', [CaregiverController::class, 'showProfile'])->name('profile.profile');


// เส้นทางสำหรับแสดงรายการผู้ดูแล (Caregiver Listing)
Route::get('/caregiver', [CaregiverController::class, 'showFindCaregiver'])->name('caregiver');

// เส้นทางสำหรับการสมัครเป็นผู้ดูแล (Registration Routes)
Route::prefix('caregiver')->group(function () {
    Route::get('/register', [CaregiverController::class, 'showApplicationForm'])->name('caregiver.register');
    Route::post('/apply', [CaregiverController::class, 'submitApplication'])->name('caregiver.apply');
    Route::get('/await-review', [CaregiverController::class, 'awaitReview'])->name('caregiver.awaitReview');
    Route::get('/confirm-status', [CaregiverController::class, 'confirmStatus'])->name('caregiver.confirmStatus');
});

// เส้นทางสำหรับแผงควบคุมผู้ดูแล (Admin Dashboard Routes)
Route::prefix('dashboard')->group(function () {
    Route::get('/caregiver-management', [CaregiverController::class, 'showDashboardCaregiverManagement'])->name('dashboard.caregiver-management');
    Route::patch('/caregivers/{id}/update-status', [CaregiverController::class, 'updateStatus'])->name('caregivers.updateStatus');
});

Route::get('/caregiver/search', [CaregiverController::class, 'findNearby'])->name('caregivers.search');
Route::get('/caregivers/nearby', [CaregiverController::class, 'findNearby'])->name('caregivers.nearby');


