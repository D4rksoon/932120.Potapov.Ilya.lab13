<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home']);

Route::get('/Mockups', [MainController::class, 'mockups']);

Route::get('/Mockups/Quiz', [MainController::class, 'quiz']);
Route::post('/Mockups/Quiz', [MainController::class, 'quiz_next']);
Route::get('/Mockups/Quiz/Result', [MainController::class, 'quiz_result']);


