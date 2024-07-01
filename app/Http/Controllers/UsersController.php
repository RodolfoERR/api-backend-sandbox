<?php

namespace App\Http\Controllers;

use App\Jobs\MailSender;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    
    public function getMyself(Request $request){
        try{
            return response()->json([
               'data' => $request->user()
            ], 200);
        }catch(Exception $e){
            if($e){
                // Log::channel('custom')->error($request, [$e]);
                // Log::channel('slack')->error($request, [$e]);
                
                return response()->json([
                    'error_code' => 10002,
                    'message' => 'Please contact with the developer',
                ], 422);
            }
        }
    }

    public function createUser(Request $request){
        $validation = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required'
        ]);

        if($validation->fails())
            return response()->json(['message' => 'unsuccessful...','errors' => $validation->errors()], 400);

        try{
            $user = new User();
        
            $user->name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->role_id = 2;

            $user->save();
        }catch(Exception $e){
            if($e){                
                Log::channel('custom')->error($request, [$e]);
                Log::channel('slack')->error($request, [$e]);

                return response()->json([
                    'error_code' => 10000,
                    'message' => 'Please contact with the developer',
                ], 422);
            }
        }
        
        try{
            $url = URL::temporarySignedRoute('first-Auth', now()->addMinutes(40), ['id' => $user->id]);
            MailSender::dispatch($user, $url, "register")->delay(now()->addSeconds(1));
        }catch(Exception $e){
            if($e){
                // Log::channel('custom')->error($request, [$e]);
                // Log::channel('slack')->error($request, [$e]);

                return response()->json([
                    'error_code' => 10001,
                    'message' => 'Please contact with the developer'
                ], 422);
            }
        }


        return response()->json([
            'message'   => 'Please check your mail to continue',
        ], 200);
    }
}
