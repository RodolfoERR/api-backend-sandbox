<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rack;
use Exception;
use Illuminate\Support\Facades\Validator;

class RackController extends Controller
{
    public function index(){
        try{
            $racks = Rack::where('active', true)->get();
            return response()->json(['message'=>'success', 'data'=>$racks]);
        }catch(Exception $e){
            if($e)
                $this->messageError("index racks");
        }
    }

    public function storeRack(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ], [
            'name.required' => 'necesitamos el nombre',
            'name.string' => 'debe ser string',
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);

        try{
            $rack = new Rack();
            $rack->name = $request->name;
            $rack->save();

            return response()->json(['message'=> 'sucess'], 201);
        }catch(Exception $e){
            if($e)
                $this->messageError("store rack");
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ], [
            'name.required' => 'Necesitamos el nombre de la torre',
        ]);

        if($validator->fails())
        return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);

        try{
            $rack = Rack::findOrFail($id);
            if(!$rack)
                return response()->json(['message'=>'Not found'], 404); 

            $rack->name = $request->name;
            $rack->save();

            return response()->json(["message"=>"success"]);
        }catch(Exception $e){
            if($e)
                $this->messageError("update rack");
        }
    }

    public function destroy($id){
        try{
            $rack = Rack::findOrFail($id);
            if(!$rack)
                return response()->json(['message'=>'Not found'], 404); 

            $rack->active = false;
            $rack->save();
            
            return response()->json(null, 204);
        }catch(Exception $e){
            if($e)
                $this->messageError("destroy rack");
        }
    }

    private function messageError($error){
        return response()->json(['message' => 'Contacta al desarrollador, error en'.$error], 400);
    }
}
