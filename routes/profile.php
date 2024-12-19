<?php 

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CaregiverController; 
use App\Http\Controllers\Carefield\HealthCheckController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/personal-info', [ProfileController::class, 'updatePersonalInfo'])->name('profile.updatePersonalInfo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Caregiver edit route
    Route::get('/caregiver/edit', [CaregiverController::class, 'edit'])->name('caregiver.edit')->middleware('auth');
    Route::patch('/caregiver/update', [CaregiverController::class, 'update'])->name('caregiver.update');

    Route::get('/profile/healthcheck', [HealthCheckController::class, 'show'])->name('healthcheck.show');
});
