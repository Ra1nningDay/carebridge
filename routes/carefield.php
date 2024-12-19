<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminOnly;
use App\Http\Controllers\Carefield\AuthorityController;
use App\Http\Controllers\Carefield\PatientController;
use App\Http\Controllers\Carefield\FormController;
use App\Http\Controllers\Carefield\HealthCheckController;
use App\Http\Controllers\Carefield\Dashboard\CareFieldDashboardController;

//หน้า Dashboard
Route::middleware(['auth', 'verified', AdminOnly::class])->group(function () {
    
});


Route::middleware(['auth', 'verified', AdminOnly::class])->group(function () {
    Route::get('/carefield', [CareFieldDashboardController::class, 'index'])->name('carefield.index');
    Route::get('/carefield/patients', [PatientController::class, 'index'])->name('carefield.patient');
    Route::post('/carefield/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/carefield/forms', [FormController::class, 'index'])->name('carefield.form');

    // เส้นทางสำหรับ HealthCheck
    Route::post('/carefield/health-checks', [HealthCheckController::class, 'store'])->name('health_checks.store'); // สำหรับบันทึกข้อมูล
    Route::get('/carefield/health-checks/{id}/edit', [HealthCheckController::class, 'edit'])->name('health_checks.edit'); // สำหรับแก้ไขข้อมูล
    Route::put('/carefield/health-checks/{id}', [HealthCheckController::class, 'update'])->name('health_checks.update'); // สำหรับอัปเดตข้อมูล
    Route::delete('/carefield/health-checks/{id}', [HealthCheckController::class, 'destroy'])->name('health_checks.destroy'); // สำหรับลบข้อมูล
});


