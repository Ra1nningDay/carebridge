<?php 
use App\Http\Controllers\ZoomController;

// สำหรับเริ่มกระบวนการ OAuth
Route::get('zoom/authorize', [ZoomController::class, 'authorize'])->name('zoom.authorize');

// สำหรับรับ Callback หลังจากการอนุญาต
Route::get('zoom/callback', [ZoomController::class, 'callback'])->name('zoom.callback');

// สำหรับสร้างห้องประชุม Zoom โดยเชื่อมโยงกับการนัดหมาย
Route::post('appointments/{appointment}/create-zoom', [ZoomController::class, 'createMeetingAndSaveLink'])
    ->name('appointments.createZoom');
