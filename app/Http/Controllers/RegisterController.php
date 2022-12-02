<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Notifications\RegisterNotification;
use Illuminate\Support\Facades\Response;
use App\Notifications\EmailVerificationNotification;
class RegisterController extends Controller
{
    //
    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',


            'email' => 'required|email|unique:users',

            'phone' => 'sometimes|unique:users,phone|digits_between:10,20',

            'password' => 'required|min:6',

            'c_password' => 'required|same:password',

        ]);

        if($validator->fails()){

            return response()->json([

                'data' => $validator->errors(),
            ]);


        }

       $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $input['role'] ='user';
        $input['status'] ='active';

        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;

        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        $success['phone'] =  $user->phone;
        $success['role'] =  $user->role;
        $success['status'] =  $user->status;
        $success['success'] =  true;
        $user->notify(new RegisterNotification());
        $user->notify(new EmailVerificationNotification());



        return response()->json([
            'message' => 'User register successfully.',
            'data' =>$success, 200
        ]);

    }
}
