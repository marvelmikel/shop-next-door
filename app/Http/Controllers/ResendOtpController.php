<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResendOtpRequest;
use  App\Notifications\ResendOtpNotification;
use App\Models\User;

class ResendOtpController extends Controller
{
    public function resendOtp(ResendOtpRequest $request){
        $input = $request->only('email');
        $user = User::where('email', $input)->first();
        $user->notify(new ResendOtpNotification());
        $success['success'] = true;
        return response()->json([
            'message' => 'Otp Resent Successfully.',
             'data' => $success,200
            ]);

    }
}
