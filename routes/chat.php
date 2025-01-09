<?php 
use App\Http\Controllers\ChatController;

Route::middleware(['auth'])->group(function () {
    // เริ่มต้นการสนทนากลุ่ม
    // Route::get('/chat/start/{appointmentId}', [ChatController::class, 'startGroupConversation'])->name('chat.start'); 

    // เริ่มต้นการสนทนากับผู้ใช้คนเดียว
    Route::get('/chat/start/{userId}', [ChatController::class, 'startConversation'])->name('chat.start'); // ถ้าคุณยังต้องการเริ่มการสนทนากับคนเดียว
    
    // แสดงหน้าแชท
    Route::get('/chat/{id}', [ChatController::class, 'showConversation'])->name('chat.show');

    // ส่งข้อความ
    Route::post('/chat/{id}/send', [ChatController::class, 'sendMessage'])->name('chat.send');

    // ดึงข้อความแบบ AJAX
    Route::get('/chat/{id}/messages', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
});
    