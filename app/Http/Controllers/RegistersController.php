<?php

namespace App\Http\Controllers;

use App\Models\Refaction;
use App\Models\Register;
use App\Models\Register_Detail;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Events\ReportCreated;
use Illuminate\Support\Facades\Log;

class RegistersController extends Controller
{
    public function allReports(){
        try{
            $reports = Register::with(['registerDetail'])->get();
            return response()->json(["message"=>"success", "Data"=>$reports]);
        }catch(Exception $e){
            if($e)
                return response()->json(["message"=>"Failing retrieving data"]);
        }
    }

    public function byIdReports(int $id){
        try{
            $report = Register::with(['registerDetail'])->find($id);
            return response()->json(["message"=>"success", "Data"=>$report]);
        }catch(Exception $e){
            if($e)
                return response()->json(["message"=>"Failing retrieving data"]);
        }
    }

    public function byUserReports(Request $request){
        try{
            $reports = Register::with(['registerDetail'])->where('user_id', $request->user()->id)->get();
            return response()->json(["message"=>"success", "Data"=>$reports]);
        }catch(Exception $e){
            if($e)
                return response()->json(["message"=>"Failing retrieving data"]);
        }
    }

    public function byIDUserReports(Request $request, int $id){
        try{
            $reports = Register::with(['registerDetail'])
                ->where('user_id', $request->user()->id)
                    ->where('id', $id)
                        ->get();
            return response()->json(["message"=>"success", "Data"=>$reports]);
        }catch(Exception $e){
            if($e)
                return response()->json(["message"=>"Failing retrieving data"]);
        }
    }
    
    public function createReport(Request $request){
        $validator = Validator::make($request->all(), [
            'arr_refaction' => 'required|array|min:1',
            'arr_refaction.*.refaction_id' => 'required|integer|exists:refactions,id',
            'arr_refaction.*.quantity' => 'required|integer|min:1'
        ], [
            'arr_refaction.required' => 'El arreglo de refacciones es requerido',
            'arr_refaction.array' => 'El formato de refacciones debe ser un arreglo',
            'arr_refaction.min' => 'Debe haber al menos una refacción en el arreglo',
            'arr_refaction.*.refaction_id.required' => 'El ID de la refacción es requerido',
            'arr_refaction.*.refaction_id.integer' => 'El ID de la refacción debe ser un número entero',
            'arr_refaction.*.refaction_id.exists' => 'La refacción debe existir en la base de datos',
            'arr_refaction.*.quantity.required' => 'La cantidad es requerida',
            'arr_refaction.*.quantity.integer' => 'La cantidad debe ser un número entero',
            'arr_refaction.*.quantity.min' => 'La cantidad debe ser al menos 1'
        ]);

        $validator->after(function ($validator) use ($request) {
            $refactionIds = array_column($request->input('arr_refaction'), 'refaction_id');
            if (count($refactionIds) !== count(array_unique($refactionIds))) 
                $validator->errors()->add('arr_refaction', 'El arreglo de refacciones contiene IDs repetidos.');
        });
        
        if($validator->fails())
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);

        try{
            foreach($request->arr_refaction as $r){
                $refactionCheck = Refaction::findOrFail($r["refaction_id"]);
                if($refactionCheck["total_quantity"] < $r["quantity"])
                    return response()->json(['error' => 'Datos no aceptados', 
                        'errors' => 'No puedes sacar mas de la cantidad existente en id:'.
                            $refactionCheck->id.", nombre:".$refactionCheck->name]);
            }

            $register = new Register();
            $register->user_id = $request->user()->id;
            $register->save();

            foreach($request->arr_refaction as $refaction){
                $refactionEdit = Refaction::findOrFail($refaction["refaction_id"]);
                $refactionEdit["total_quantity"] = $refactionEdit["total_quantity"] - $refaction["quantity"];
                $refactionEdit->save();
                
                $register_details = new Register_Detail();
                $register_details->quantity = $refaction["quantity"];
                $register_details->total = $refactionEdit["unit_price"] * $refaction["quantity"];                
                $register_details->register_id = $register["id"];
                $register_details->refaction_id = $refaction["refaction_id"];
                $register_details->save();

                $reportData[] = [
                    'user' => $request->user()->f_name,
                    'refaction' => $refactionEdit->name,
                    'quantity' => $refaction["quantity"],
                    'date' => $register_details->created_at
                ];
            }
            try {
                Log::info('Datos para el evento ReportCreated: ' . json_encode($reportData));
                event(new ReportCreated($reportData));
                Log::info('Evento ReportCreated disparado.');
            } catch (Exception $e) {
                Log::error('Error al disparar el evento ReportCreated: ' . $e->getMessage());
            }
            return response()->json(["message"=>"success..."]);
        }catch(Exception $e){
            if($e)
                $this->messageError('createReport Function'); 
        }
    }

    // public function createReport(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'arr_refaction' => 'required|array|min:1',
    //         'arr_refaction.*.refaction_id' => 'required|integer|exists:refactions,id',
    //         'arr_refaction.*.quantity' => 'required|integer|min:1'
    //     ], [
    //         'arr_refaction.required' => 'El arreglo de refacciones es requerido',
    //         'arr_refaction.array' => 'El formato de refacciones debe ser un arreglo',
    //         'arr_refaction.min' => 'Debe haber al menos una refacción en el arreglo',
    //         'arr_refaction.*.refaction_id.required' => 'El ID de la refacción es requerido',
    //         'arr_refaction.*.refaction_id.integer' => 'El ID de la refacción debe ser un número entero',
    //         'arr_refaction.*.refaction_id.exists' => 'La refacción debe existir en la base de datos',
    //         'arr_refaction.*.quantity.required' => 'La cantidad es requerida',
    //         'arr_refaction.*.quantity.integer' => 'La cantidad debe ser un número entero',
    //         'arr_refaction.*.quantity.min' => 'La cantidad debe ser al menos 1'
    //     ]);

    //     $validator->after(function ($validator) use ($request) {
    //         $refactionIds = array_column($request->input('arr_refaction'), 'refaction_id');
    //         if (count($refactionIds) !== count(array_unique($refactionIds))) 
    //             $validator->errors()->add('arr_refaction', 'El arreglo de refacciones contiene IDs repetidos.');
    //     });
        
    //     if($validator->fails())
    //         return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);

    //     try{
    //         foreach($request->arr_refaction as $r){
    //             $refactionCheck = Refaction::findOrFail($r["refaction_id"]);
    //             if($refactionCheck["total_quantity"] < $r["quantity"])
    //                 return response()->json(['error' => 'Datos no aceptados', 
    //                     'errors' => 'No puedes sacar más de la cantidad existente en id:'.
    //                         $refactionCheck->id.", nombre:".$refactionCheck->name]);
    //         }

    //         $register = new Register();
    //         $register->user_id = $request->user()->id;
    //         $register->save();

    //         foreach($request->arr_refaction as $refaction){
    //             $refactionEdit = Refaction::findOrFail($refaction["refaction_id"]);
    //             $refactionEdit["total_quantity"] = $refactionEdit["total_quantity"] - $refaction["quantity"];
    //             $refactionEdit->save();
                
    //             $register_details = new Register_Detail();
    //             $register_details->quantity = $refaction["quantity"];
    //             $register_details->total = $refactionEdit["unit_price"] * $refaction["quantity"];                
    //             $register_details->register_id = $register["id"];
    //             $register_details->refaction_id = $refaction["refaction_id"];
    //             $register_details->save();

    //             $data = [
    //                 'user' => $request->user()->name,
    //                 'refaction' => $refactionEdit->name,
    //                 'quantity' => $refaction["quantity"],
    //                 'date' => now()->toDateTimeString()
    //             ];

    //             $this->sendSSE($data);
    //         }

    //         return response()->json(["message"=>"success..."]);
    //     }catch(Exception $e){
    //         if($e)
    //             $this->messageError('createReport Function'); 
    //     }
    // }

    public function editReport(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'arr_refaction' => 'required|array|min:1',
            'arr_refaction.*.refaction_id' => 'required|integer|exists:refactions,id',
            'arr_refaction.*.quantity' => 'required|integer|min:1'
        ], [
            'arr_refaction.required' => 'El arreglo de refacciones es requerido',
            'arr_refaction.array' => 'El formato de refacciones debe ser un arreglo',
            'arr_refaction.min' => 'Debe haber al menos una refacción en el arreglo',
            'arr_refaction.*.refaction_id.required' => 'El ID de la refacción es requerido',
            'arr_refaction.*.refaction_id.integer' => 'El ID de la refacción debe ser un número entero',
            'arr_refaction.*.refaction_id.exists' => 'La refacción debe existir en la base de datos',
            'arr_refaction.*.quantity.required' => 'La cantidad es requerida',
            'arr_refaction.*.quantity.integer' => 'La cantidad debe ser un número entero',
            'arr_refaction.*.quantity.min' => 'La cantidad debe ser al menos 1'
        ]);
    
        $validator->after(function ($validator) use ($request) {
            $refactionIds = array_column($request->input('arr_refaction'), 'refaction_id');
            if (count($refactionIds) !== count(array_unique($refactionIds))) {
                $validator->errors()->add('arr_refaction', 'El arreglo de refacciones contiene IDs repetidos.');
            }
        });
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Datos no aceptados', 'errors' => $validator->errors()], 400);
        }
    
        try {
            $register = Register::findOrFail($id);
    
            foreach ($request->arr_refaction as $r) {
                $refactionCheck = Refaction::findOrFail($r["refaction_id"]);
                if ($refactionCheck["total_quantity"] < $r["quantity"]) {
                    return response()->json(['error' => 'Datos no aceptados', 
                        'errors' => 'No puedes sacar más de la cantidad existente en id:' . 
                            $refactionCheck->id . ", nombre:" . $refactionCheck->name], 400);
                }
            }

            $existingDetails = $register->registerDetail;
            foreach ($existingDetails as $detail) {
                $refaction = Refaction::findOrFail($detail->refaction_id);
                $refaction->total_quantity += $detail->quantity;
                $refaction->save();
            }
    
            Register_Detail::where('register_id', $id)->delete();

            foreach ($request->arr_refaction as $refaction) {
                $refactionEdit = Refaction::findOrFail($refaction["refaction_id"]);
                $refactionEdit["total_quantity"] = $refactionEdit["total_quantity"] - $refaction["quantity"];
                $refactionEdit->save();
    
                $register_details = new Register_Detail();
                $register_details->quantity = $refaction["quantity"];
                $register_details->total = $refactionEdit["unit_price"] * $refaction["quantity"];
                $register_details->register_id = $register["id"];
                $register_details->refaction_id = $refaction["refaction_id"];
                $register_details->save();
            }
    
            return response()->json(["message" => "success..."]);
    
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al editar el reporte', 'message' => $e->getMessage()], 500);
        }
    }

    private function messageError($error){
        return response()->json(['message' => 'Contacta al desarrollador, error en'.$error], 400);
    }
}
