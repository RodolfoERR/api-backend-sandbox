<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refaction;
use Exception;

class HiddenController extends Controller
{
    public function readAllRefactionsMinus(){
        try{
            $refactions = Refaction::with('type')->get()->map(function ($refaction) {
                $refaction->image = url('images/' . $refaction->image);
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

            foreach ($refactions as $refaction) {
                $refaction->setHidden($hiddenRefaction);
                $refaction->setHidden($hiddenType);
            }

            return response()->json(['message' => 'success', 'data' => $refactions], 200, [], JSON_UNESCAPED_SLASHES);
        }catch(Exception $e){
            if($e)
                $this->messageError('readAllRefactions Function');
        }
    }
}
