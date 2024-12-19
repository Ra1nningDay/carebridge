<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact'); // บันทึกข้อมูลการเข้าชม
Route::post('/visits', [VisitController::class, 'store'])->name('visit.store'); // บันทึกข้อมูลการเข้าชม


require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/posts.php';
require __DIR__.'/caregiver.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/chatbot.php';
require __DIR__.'/carefield.php';
require __DIR__.'/rating.php';
require __DIR__.'/survey.php';
require __DIR__.'/chat.php';
require __DIR__.'/evaluation.php';

// ภาษา
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'th'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
});



