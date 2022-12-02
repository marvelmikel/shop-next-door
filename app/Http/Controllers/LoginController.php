<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Notifications\LoginNotification;
class LoginController extends Controller
{
    //
    public function login(Request $request)

    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;

            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['success'] =  true;
            $user->notify(new LoginNotification());


            return response()->json([
                'message' => 'User login successfully.',
                'data' =>$success, 200
            ]);


        }

        else{

            return response()->json([
                'message' => 'Unauthorized.',
                'error'=>'Invalid Password or Email',
            ],401);
        }

    }
}
