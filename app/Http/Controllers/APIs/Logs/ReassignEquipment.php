<?php

namespace App\Http\Controllers\APIs\Logs;

use App\Http\Controllers\APIs\logs;
use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use Illuminate\Http\Request;

class ReassignEquipment extends Controller
{

    public function reassignEquipment(requestStoreLogs $request)
    {
        if (!$request->isJson()) {
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);
        } else {
            $logs_api = new logs;
            $response_logs_api = $logs_api->assignmentModelRequest($request);
            if ($response_logs_api) {
                return response()->json([
                    'Response' => 'Equipo asignado correctamente',
                    $response_logs_api
                ], 201);
            } else {
                return response()->json([
                    'Error' => 'Hubo un error al reasignar el equipo'
                ], 401);
            }
        }
    }
}
