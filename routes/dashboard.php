<?php 

use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Survey\HealthAssessmentController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\EvaluationController;
use App\Http\Controllers\Dashboard\SurveyController;
use App\Http\Controllers\Dashboard\RatingController; // นำเข้า RatingController

// Admin Dashboard Routes
Route::prefix('dashboard')->middleware(['auth', 'verified', AdminOnly::class])->group(function () {
    // หน้า Dashboard หลัก
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ข้อมูลสาธารณะ
    Route::get('/public-infomation', [PostController::class, 'dashboard'])->name('dashboard.public-information');

    // การจัดการข้อมูลความเสี่ยง (Risk Information Management)
    Route::prefix('risks')->name('dashboard.risks.')->group(function () {
        // สรุปข้อมูลเกี่ยวกับความเสี่ยงในกลุ่มผู้สูงอายุ หัวข้อ BGS (Health Risks)
        Route::get('/summary', [HealthAssessmentController::class, 'dashboard'])->name('summary');

        // // แผนที่สำหรับแสดงข้อมูล (Map)
        // Route::get('/map', [DashboardController::class, 'map'])->name('map');

        // // ค่าตัวชี้วัดความสำเร็จ (KPIs)
        // Route::get('/kpis', [DashboardController::class, 'kpis'])->name('kpis');

        // // ข้อมูลเตือนภัย (Alerts)
        // Route::get('/alerts', [DashboardController::class, 'alerts'])->name('alerts');
    });

    // การจัดการผู้ใช้งาน (User Management)
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('dashboard.user-management');
    Route::patch('/user-management/{id}', [UserManagementController::class, 'update'])->name('dashboard.user-management.update');

    // การจัดการการประเมิน (Evaluation Management)
    Route::prefix('evaluations')->name('evaluations.')->group(function () {
        // แสดงรายการการประเมิน (Index)
        Route::get('/', [EvaluationController::class, 'index'])->name('index');

        // การเพิ่มการประเมินใหม่ (Store)
        Route::post('/', [EvaluationController::class, 'store'])->name('store');

        // แก้ไขการประเมิน (Edit)
        Route::get('/{id}/edit', [EvaluationController::class, 'edit'])->name('edit');

        // อัปเดตการประเมิน (Update)
        Route::put('/{id}', [EvaluationController::class, 'update'])->name('update');

        // ลบการประเมิน (Destroy)
        Route::delete('/{evaluationTopic}', [EvaluationController::class, 'destroy'])->name('destroy');
    });

    // การจัดการการให้คะแนน (Rating Management - ใหม่)
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
});
