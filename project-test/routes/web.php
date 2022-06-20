<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ForgotController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SignInController::class, 'index']);

Route::post('sign-in', [SessionController::class, 'beginSession']);

Route::get('sign-up', [SignUpController::class, 'show'])->middleware('guest');

Route::post('sign-up', [SignUpController::class, 'createUser'])->middleware('guest');

Route::post('sign-out', [SessionController::class, 'endSession']);

Route::get('forgot-password', [ForgotController::class, 'show']);

Route::post('forgot-password', [ForgotController::class, 'sendVerificationLink'])->middleware('guest');

Route::get('reset-password/{code}', [ForgotController::class, 'resetPasswordPage'])->middleware('guest');

Route::post('reset-password', [ForgotController::class, 'resetPassword'])->middleware('guest');