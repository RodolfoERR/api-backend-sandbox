<?php

namespace App\Http\Controllers;

use App\Jobs\MailSender;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class AccessController extends Controller
{
    public function logIn(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails())
            return response()->json(['message' => 'unsuccessful va1...','errors' => [$validator->errors()]], 400);

        $user = User::where('email', $request->email)->where('active', true)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password))
            return response()->json(['message' => 'incorrect User or Password'], 401);

        if($user->role_id === 1 && $user->code !== null){
            $validatorAdmin = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
                'code' => 'required'
            ], [
                'code' => [
                    'required' => 'Check your Email'
                ]
            ]);

            if($validatorAdmin->fails())
                return response()->json(['message' => 'unsuccessful va2...','errors' => $validatorAdmin->errors()], 400);

            if(Hash::check($request->code, $user->code)){
                try{
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $user->code = null;
                    $user->save();
                    return response()->json(['message' => 'Welcome','token' => $token], 200);
                }catch(Exception $e){
                    if($e){
                        // Log::channel('custom')->error($request, [$e]);
                        // Log::channel('slack')->error($request, [$e]);

                        return response()->json([
                            'error_code' => 10004,
                            'message' => 'Please contact with the developer',
                        ], 422);
                    }
                }
            }else{
                return response()->json(['message' => 'incorrect User or Password or Code access'], 401);
            }
        }else if($user->role_id === 1 && $user->code === null){
            try{
                $code = random_int(100000, 999999);
                $user->code = Hash::make($code);
                
                $user->save();
                MailSender::dispatch($user, $code)->delay(now()->addSeconds(1));
            }catch(Exception $e){
                if($e){
                    // Log::channel('custom')->error("Error Check Code or URL", [$e]);
                    // Log::channel('slack')->error("Error Check Code or URL", [$e]);

                    return response()->json([
                        'error_code' => 10005,
                        'message' => 'Please contact with the developer',
                    ], 422);
                }
            }

            $validatorAdmin = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
                'code' => 'required'
            ], [
                'code' => [
                    'required' => 'Check your Email'
                ]
            ]);

            if($validatorAdmin->fails())
                return response()->json(['message' => 'unsuccessful va3...','errors' => $validatorAdmin->errors()], 400);

            return response()->json(['message' => 'incorrect User or Password or Code access'], 401);
        }

        return response()->json(['message' => 'incorrect User or Password or Code access'], 401);
        /*$token = $user->createToken('auth_token')->plainTextToken;        
        return response()->json(['message' => 'Welcome','token' => $token], 200);*/
    }
    

    public function logOut(Request $request){
        $request->user()->tokens()->delete();
        return  response()->json(['message' => 'Good Bye'], 204);
    }

    public function lastAuth(Request $request, int $id){
        if(!$request->hasValidSignature())
            return view('expired');

        $validate = Validator::make($request->all(),[
            'code' => 'required'
        ]);

        if($validate->fails())
            return response()->json(['message' => 'unsuccessful...','errors' => $validate->errors()], 400);

        $user = User::find($id);

        if(!$user)
            return response()->json(['message' => 'error 404 not found'], 404);

        if($user->active)
            return view('expired');
            // return response()->json(['message' => 'User already verified'], 304);
        
        if($user->code != $request->code || Hash::check($request->code, $user->code))
            return response()->json(['message' => 'unsuccessful...'], 400);

        $user->active = true;
        $user->save();

        return response()->json(['message' => 'Welcome'], 200);
    }
}
