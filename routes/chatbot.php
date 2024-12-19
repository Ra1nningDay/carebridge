<?php

use App\Http\Controllers\ChatbotController;

Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');
