<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypesController extends Controller
{
    public function createType(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:types,name'
        ],[
            'name' => [
                'required' => 'Necesitamos el nombre del nuevo tipo',
                'unique'   => 'Ya existe ese tipo'
            ]
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);

        try{
            $type = new Type();
            $type->name = $request->name;
            $type->save();

            return response()->json(['message' => 'success...', 'data' => $type], 202);
        }catch(Exception $e){
            if($e)
                $this->messageError('createType Function');
        }
    }

    public function readTypes(){
        try{
            $types = Type::all();
            return response()->json(['message' => 'success', 'data' => $types], 202);
        }catch(Exception $e){
            if($e)
                $this->messageError('readTypes Function');
        }
    }

    public function updateType(Request $request, int $id){
        try{
            $type = Type::find($id)->first();
            
            if(!$type)
                return response()->json(['message' => 'Not found'], 404);

            $type->name = $request->name?? $type->name;

            $type->save();
            
            return response()->json(['message' => 'success...', 'data' => $type], 202);
        }catch(Exception $e){
            if($e){
                $this->messageError('updateType Function');
            }
        }
    }

    // public function deleteType(int $id) {
    //     try{
    //         $type = Type::find($id)->first();

    //         if(!$type)
    //             return response()->json(['message'=>'Not found'], 404);

    //         $type->active = false;
    //         $type->save();

    //         return response()->json(['message'=>'removed']);
    //     }catch(Exception $e){
    //        if($e)
    //         $this->messageError('deleteType Function'); 
    //     }
    // }

    private function messageError($error){
        return response()->json(['message' => 'Contacta al desarrollador, error en'.$error], 400);
    }
}
