<?php

namespace App\Http\Controllers\APIs\Logs;

use App\Http\Controllers\APIs\logs;
use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use App\Models\Logs as ModelsLogs;
use Illuminate\Http\Request;

class RegisterEquipment extends Controller
{

    public function registerEquipment(requestStoreLogs $request)
    {
        if (!$request->isJson()) {
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);
        } else {

            $logs_api = new logs;
            $search_inventory_id = $request->inventory_id;


            if ($request->type === "Registrar") {
                $search_log_type = 'Registrar';
                $consult_response = ModelsLogs::where(function ($query) use ($search_log_type, $search_inventory_id) {
                    $query->where('type', $search_log_type)
                        ->where('inventory_id', $search_inventory_id);
                })->get();
                if (sizeof($consult_response) == 0) {

                    $response_logs_api = $logs_api->assignmentModelRequest($request);

                    return response()->json([
                        'Response' => 'Usuario registrado correctamente',
                        $response_logs_api
                    ], 201);
                } else {
                    return response()->json([
                        'Error' => 'Este equipo ya fue registrado en el sistema con sus caracteristicas de fabrica'
                    ], 401);
                }
            }
        }
    }
}
