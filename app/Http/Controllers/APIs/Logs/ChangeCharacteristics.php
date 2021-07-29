<?php

namespace App\Http\Controllers\APIs\Logs;

use App\Http\Controllers\APIs\logs;
use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use Illuminate\Http\Request;

class ChangeCharacteristics extends Controller
{

    public function changeCharacteristics(requestStoreLogs $request)
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
                    'Response' => 'Usuario actualizado correctamente',
                    $response_logs_api
                ], 201);
            } else {
                return response()->json([
                    'Error' => 'Hubo un error al actualizar este usuario'
                ], 401);
            }
        }
    }
}
