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
            'fingerprint' => 'required|string',
        ], [
            'fingerprint.required' => 'La huella digital es requerida',
            'fingerprint.string' => 'La huella digital debe ser una cadena de texto',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        }

        $user = User::findOrFail($request->user()->id);

        // $fingerprintHash = Hash::make($request->input('fingerprint'));
        $fingerprintHash = $request->fingerprint;

        $user->fingerprint = $fingerprintHash;

        return response()->json([
            'success' => true,
            'message' => 'Huella digital almacenada correctamente.'
        ]);
    }

    public function checkingFingerprint(Request $request){
        $validator = Validator::make($request->all(), [
            'fingerprint' => 'required|string',
        ], [
            'fingerprint.required' => 'La huella digital es requerida',
            'fingerprint.string' => 'La huella digital debe ser una cadena de texto',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        }

        $user = User::findOrFail($request->user()->id);

        $storedFingerprint = $user->fingerprint;
        $receivedFingerprint = $request->input('fingerprint');

        if ($this->compareFingerprints($storedFingerprint, $receivedFingerprint)) {
            return response()->json([
                'success' => true,
                'message' => 'Las huellas digitales coinciden.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Las huellas digitales no coinciden.'
            ]);
        }
    }

    private function compareFingerprints($storedFingerprint, $receivedFingerprint){
        return hash_equals($storedFingerprint, $receivedFingerprint);
    }
}
