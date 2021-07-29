<?php

namespace App\Http\Controllers\APIs\Logs;

use App\Http\Controllers\APIs\logs;
use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use Illuminate\Http\Request;

class ChangeCharacteristics extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeCharacteristics(requestStoreLogs $request)
    {
        $logs_api = new logs;
        $log = $logs_api->asignacion($request);
        if($log){
            return response()->json([
                'Response' => 'Usuario actualizado correctamente',
                $log
            ], 201);
        } else {
            return response()->json([
                'Error' => 'Hubo un error al actualizar este usuario'
            ], 401);
        }
    }

}
