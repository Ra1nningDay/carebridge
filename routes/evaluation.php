<?php 
use App\Http\Controllers\Dashboard\EvaluationController;

Route::get('/evaluations', [EvaluationController::class, 'form'])->name('evaluations.form');