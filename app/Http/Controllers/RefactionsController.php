<?php

namespace App\Http\Controllers;

use App\Models\Refaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefactionsController extends Controller
{
    public function readAllRefactions(){
        try{
            $refactions = Refaction::all();
            return response()->json(['message' => 'success', 'data' => $refactions], 202);
        }catch(Exception $e){
            if($e)
                $this->messageError('readAllRefactions Function');
        }
    }

    public function createRefaction(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:refactions,name',
            'description' => 'required',
            'total_quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'type_id' => 'required|exists:type,id',
            'location_id' => 'required|exists:location,id'
        ],[
            'name' => [
                'required' => 'Necesitamos el nombre de la refaccion',
                'unique' => 'No puede haber dos refacciones con el mismo nombre',
            ],
            'description' => [
                'required' => 'Necesitamos la descripcion de la refaccion'
            ],
            'total_quantity' => [
                'required' => 'Necesitamos la cantidad disponible',
                'numeric' => 'Debe ser valor numerico'
            ],
            'unit_price' => [
                'required' => 'Necesitamos el precio por unidad',
                'numeric' => 'Debe ser valor numerico'
            ],
            'type_id' => [
                'required' => 'Necesitamos el tipo de refaccion',
                'exists' => 'Debe existir el tipo'
            ], 
            'location_id' => [
                'required' => 'Necesitamos la localizacion de almacenamiento',
                'exists' => 'Debe existir la localizacion'
            ]
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        
    }

    private function messageError($error){
        return response()->json(['message' => 'Contacta al desarrollador, error en'.$error], 400);
    }
}
