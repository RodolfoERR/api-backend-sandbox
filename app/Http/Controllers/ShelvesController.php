<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use Exception;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShelvesController extends Controller
{
    public function getShelves(){
        try{
            $locations = Shelf::with(['level', 'rack'])->get();
            return response()->json(['message' => 'success', 'data' => $locations], 202);
        }catch(Exception $e){
            if($e){
                $this->messageError('getShelves');
            }
        }
    }

    public function getByID(int $id){
        try{
            $location = Shelf::with(['level', 'rack'])->findOrFail($id);

            if(!$location)
                return response()->json(['message'=>'Not found'], 404);

            return response()->json(['message'=>'success...', 'data' => $location]);
        }catch(Exception $e){
           if($e)
            $this->messageError('InGetById_Location Function'); 
        }
    }

    public function createLocation(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level_id' => 'required|exists:levels,id',
            'rack_id' => 'required|exists:racks,id'
        ], [
            'name' => [
                'required' => 'Necesitamos el nombre de la ubicacion',
            ],
            'level_id' => [
                'required' => 'Necesitamos el id del nivel almacenado',
                'exists'  => 'Debe ser existente la id'
            ],
            'rack_id' => [
                'required' => 'Necesitamos el id de la torre',
                'exists'  => 'Debe ser existente la id'
            ]
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        
        try{
            $shelf = new Shelf();
            $shelf->name = $request->name;
            $shelf->level_id = $request->level_id;
            $shelf->rack_id = $request->rack_id;
            $shelf->save();

            return response()->json(['message' => 'success...', 'data' => $shelf], 202);
        }catch(Exception $e){
            if($e)
                $this->messageError('createLocation Function');
        }
    }

    public function updateLocation(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level_id' => 'required|exists:levels,id',
            'rack_id' => 'required|exists:racks,id'
        ], [
            'name.required' => 'Necesitamos el nombre de la ubicacion',
            'level_id.required' => 'Necesitamos el id del nivel almacenado',
            'level_id.exists' => 'Debe ser existente la id',
            'rack_id.required' => 'Necesitamos el id de la torre',
            'rack_id.exists' => 'Debe ser existente la id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        }

        try {
            $shelf = Shelf::findOrFail($id);
            $shelf->name = $request->name;
            $shelf->level_id = $request->level_id;
            $shelf->rack_id = $request->rack_id;
            $shelf->save();

            return response()->json(['message' => 'Ubicación actualizada con éxito', 'data' => $shelf], 202);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar la ubicación', 'message' => $e->getMessage()], 500);
        }
    }

    public function removeLocation(int $id){
        try{
            $location = Shelf::find($id)->first();

            if(!$location)
                return response()->json(['message'=>'Not found'], 404);

            $location->active = false;
            $location->save();

            return response()->json(['message'=>'removed']);
        }catch(Exception $e){
            if($e)
                $this->messageError('removeLocation Function'); 
        }
    }

    private function messageError($error){
        return response()->json(['message' => 'Contacta al desarrollador, error en'.$error], 400);
    }
}
