<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ResendOtpController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function(){
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class,'login']);
Route::post('password/forgot-password', [ForgetPasswordController::class,'forgetPassword']);
Route::post('password/reset', [ResetPasswordController::class,'passwordReset']);


 Route::post('email-verification', [EmailVerificationController::class,'email_verification']);
Route::post('resend', [ResendOtpController::class,'resendOtp']);

});


