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
            $refactions = Refaction::with(['type', 'location.level'])->get()->map(function ($refaction) {
                $refaction->image_url = url('images/' . $refaction->image);
                return $refaction;
            });

            return response()->json(['message' => 'success', 'data' => $refactions], 200, [], JSON_UNESCAPED_SLASHES);
        }catch(Exception $e){
            if($e)
                $this->messageError('readAllRefactions Function');
        }
    }

    public function readAllRefactionsMinus(){
        try{
            $refactions = Refaction::with('type')->get()->map(function ($refaction) {
                $refaction->image_url = url('images/' . $refaction->image);
                return $refaction;
            });

            $hiddenRefaction = [
                'description',
                'total_quantity',
                'unit_price',
                'active',
                'type_id',
                'location_id',
                'image',
                'created_at',
                'updated_at'
            ];

            $hiddenType = [
                'created_at',
                'updated_at'
            ];

            foreach ($refactions as $refaction){
                $refaction->setHidden($hiddenRefaction);
                $refaction->type->setHidden($hiddenType);
            }

            return response()->json(['message' => 'success', 'data' => $refactions], 200, [], JSON_UNESCAPED_SLASHES);
        }catch(Exception $e){
            if($e)
                $this->messageError('readAllRefactions Function');
        }
    }

    public function readRefactionById(int $id){
        try{
            $refaction = Refaction::with(['type', 'location.level'])->find($id);

            if (!$refaction)
                return response()->json(['message'=>'Not found'], 404);
                
            $refaction->image_url = url('images/' . $refaction->image);
            return response()->json(['message' => 'success', 'data' => $refaction], 200, [], JSON_UNESCAPED_SLASHES);
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
            'type_id' => 'required|exists:types,id',
            'location_id' => 'required|exists:shelves,id',
            'image' => 'required|image|max:2048'
        ],[
            'name.required' => 'Necesitamos el nombre de la refacción',
            'name.unique' => 'No puede haber dos refacciones con el mismo nombre',
            'description.required' => 'Necesitamos la descripción de la refacción',
            'total_quantity.required' => 'Necesitamos la cantidad disponible',
            'total_quantity.numeric' => 'Debe ser un valor numérico',
            'unit_price.required' => 'Necesitamos el precio por unidad',
            'unit_price.numeric' => 'Debe ser un valor numérico',
            'type_id.required' => 'Necesitamos el tipo de refacción',
            'type_id.exists' => 'Debe existir el tipo',
            'location_id.required' => 'Necesitamos la localización de almacenamiento',
            'location_id.exists' => 'Debe existir la localización',
            'image.required' => 'Necesitamos una imagen de la refacción',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif',
            'image.max' => 'La imagen no debe superar los 2048KB'
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        } else {
            return response()->json(['error' => 'Error al cargar la imagen'], 400);
        }

        try{
            $refaction = new Refaction();
            $refaction->name = $request->name;
            $refaction->description = $request->description;
            $refaction->total_quantity = $request->total_quantity;
            $refaction->unit_price = $request->unit_price;
            $refaction->type_id = $request->type_id;
            $refaction->location_id = $request->location_id;
            $refaction->image = $imageName;
            $refaction->save();

            return response()->json(['success' => 'Refacción creada exitosamente', 'refaction' => $refaction], 201);
        }catch(Exception $e){
            if($e)
                $this->messageError('createRefaction Function');
        }
    }

    public function editRefaction(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'name' => 'unique:refactions,name,'.$id,
            'total_quantity' => 'numeric|min:0',
            'unit_price' => 'numeric',
            'type_id' => 'exists:types,id',
            'location_id' => 'exists:shelves,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.unique' => 'No puede haber dos refacciones con el mismo nombre',
            'total_quantity.numeric' => 'Debe ser un valor numérico',
            'total_quantity.min' => 'La cantidad total no puede ser negativa',
            'unit_price.numeric' => 'Debe ser un valor numérico',
            'type_id.exists' => 'Debe existir el tipo',
            'location_id.exists' => 'Debe existir la localización',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif',
            'image.max' => 'La imagen no debe superar los 2048KB'
        ]);
    
        if ($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
    
        try {
            $refaction = Refaction::findOrFail($id);            
            $fieldsToUpdate = ['name', 'description', 'total_quantity', 'unit_price', 'type_id', 'location_id'];
    
            foreach ($fieldsToUpdate as $field) {
                if ($request->has($field)) {
                    $refaction->$field = $request->$field;
                }
            }
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $refaction->image = $imageName;
            }
    
            $refaction->save();
    
            return response()->json(['success' => 'Refacción actualizada exitosamente', 'refaction' => $refaction], 200);
        } catch (Exception $e) {
            return $this->messageError('editRefaction Function');
        }
    }
    

    public function takingRefaction(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|min:1'
        ],[
            'quantity.numeric' => 'Necesitamos un numero',
            'quantity.min' => 'Necesitas sacar por lo menos un objeto'
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        try{
            $refaction = Refaction::findOrFail($id);
    
            if($refaction->total_quantity < $request->quantity)
                return response()->json(['error' => 'Datos no aceptados', 'errors' => 'No puedes sacar mas de la cantidad existente']);
    
            $newTotal = $refaction->total_quantity - $request->quantity;
            $refaction->total_quantity = $newTotal;
    
            $refaction->save();
    
            return response()->json(['message'=>'accion establecida correctamente']);
        }catch(Exception $e){
            if($e)
                $this->messageError("takingRefaction function");
        }
    }

    public function replenishmentRefaction(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|min:1'
        ],[
            'quantity.numeric' => 'Necesitamos un numero',
            'quantity.min' => 'Necesitas reabastecer por lo menos un objeto'
        ]);

        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        try{
            $refaction = Refaction::findOrFail($id);
    
            $newTotal = $refaction->total_quantity + $request->quantity;
            $refaction->total_quantity = $newTotal;
    
            $refaction->save();
    
            return response()->json(['message'=>'accion establecida correctamente']);
        }catch(Exception $e){
            if($e)
                $this->messageError("replenishmentRefaction function");
        }
    }

    public function deleteRefaction(int $id){
        try{
            $refaction = Refaction::findOrFail($id);
            if(!$refaction)
                return response()->json(['message'=>'Not found'], 404);
            $refaction->active = false;
            $refaction->save();

            return response()->json(['message'=>'removed']);
        }catch(Exception $e){
            if($e)
                $this->messageError('deleteRefaction Function'); 
        }
    }

    private function messageError($error){
        return response()->json(['message' => 'Contacta al desarrollador, error en'.$error], 400);
    }
}
