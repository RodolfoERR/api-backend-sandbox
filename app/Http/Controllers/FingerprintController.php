<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FingerprintController extends Controller
{
    public function storeFingerprint(Request $request){
        $validator = Validator::make($request->all(), [
            'fp' => 'required|string',
        ], [
            'fp.required' => 'La fp es requerida',
            'fp.string' => 'La fp debe ser una cadena de texto',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        }

        $user = User::findOrFail($request->user()->id);
        $user->fingerprint = $request->fp;
        $user->save();

        return response()->json([
            'message' => 'fp almacenada correctamente.'
        ]);
    }

    public function checkingFingerprint(Request $request){
        $user = User::findOrFail($request->user()->id);

        return response()->json([
            'message' => "success...",
            'data' => $user->fingerprint
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    
}
