<?php 
use App\Http\Controllers\ZoomController;

Route::get('zoom/authorize', [ZoomController::class, 'authorize'])->name('zoom.authorize');
Route::get('zoom/callback', [ZoomController::class, 'callback'])->name('zoom.callback');

