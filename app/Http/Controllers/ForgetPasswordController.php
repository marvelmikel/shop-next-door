<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use  App\Notifications\ResetPasswordVerificationNotification;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(ForgotPasswordRequest $request){
        $input = $request->only('email');
        $user = User::where('email', $input)->first();
        $user->notify(new ResetPasswordVerificationNotification());
        $success['success'] = true;
        return response()->json([
            'message' => 'Please kindly check Email , An Otp has been sent to change password.',
             'data' => $success,200
            ]);

    }
}
