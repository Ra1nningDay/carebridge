<?php 
use App\Http\Controllers\AppointmentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index'); // แสดงรายการนัดหมาย
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create'); // แสดงแบบฟอร์มการสร้างนัดหมาย
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store'); // บันทึกการนัดหมายใหม่
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show'); // แสดงรายละเอียดนัดหมาย
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update'); // อัปเดตการนัดหมาย
});
