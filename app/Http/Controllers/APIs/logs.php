<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use App\Models\Inventory;
use App\Models\Logs as ModelsLogs;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\VarDumper;

class logs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function asignacion(requestStoreLogs $request)
    {
        $log = new ModelsLogs();
        $log->type = "Actualizar";
        $log->user = $request->user;
        $log->characteristics = $request->characteristics;
        $log->employee = $request->employee;
        $log->reason = $request->reason;
        $log->inventory_id = $request->inventory_id;

        $log->save();
        return $log;
    }

    public function returnCharacteristics()
    {
        // -----------------------------
        // REALIZADO CON SHELL_EXEC
        // ----------------------------

        $execute_comand = shell_exec("systeminfo");
        $comand_response = utf8_encode($execute_comand);
        $tabulations_replace = str_replace(' ', '', $comand_response);
        $line_breaks_replace = str_replace("\n", ",", $tabulations_replace);
        $line_separation = explode(',', $line_breaks_replace);
        foreach ($line_separation as $line) {
            $key_value_characteristics = explode(':', $line);
            if (isset($key_value_characteristics[1])) {
                $characteristics_response[$key_value_characteristics[0]] = $key_value_characteristics[1];
                // $characteristics_response[$counter]=$key_value_characteristics[1];
            } else {
                $key_value_characteristics[1] = ' ';
                $characteristics_response[$key_value_characteristics[0]] = $key_value_characteristics[1];
                // $characteristics_response[$counter]=$key_value_characteristics[1];
            }
        }
        $convert_string = implode($characteristics_response);
        if ($convert_string) {
            return response()->json([
                'Response' => 'Analisis del sistema completado correctamente',
                $characteristics_response
            ], 201);
        } else {
            return response()->json([
                'Response' => 'Ocurrio un error al analizar el sistema',
            ], 401);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requestStoreLogs $request)
    {
        if (!$request->isJson()) {
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);
        } else {
            $log = new ModelsLogs();
            $search_inventory_id = $request->inventory_id;
            
            
            if ($request->type === "Registrar") {
                $search_log_type = 'Registrar';
                $consult_response = ModelsLogs::where(function ($query) use ($search_log_type, $search_inventory_id) {
                $query->where('type', $search_log_type)
                    ->where('inventory_id', $search_inventory_id);
                    })->get();
                if (sizeof($consult_response) == 0) {

                    $log->type = "Registrar";
                    $log->user = $request->user;
                    $log->characteristics = $request->characteristics;
                    $log->employee = $request->employee;
                    $log->reason = $request->reason;
                    $log->inventory_id = $request->inventory_id;

                    $log->save();

                    return response()->json([
                        'Response' => 'Usuario registrado correctamente',
                        $log
                    ], 201);
                } else {
                    return response()->json([
                        'Error' => 'Este equipo ya fue registrado en el sistema con sus caracteristicas de fabrica'
                    ], 401);
                }
            } elseif ($request->type === "Actualizar") {
                
            } elseif ($request->type === "Reasignacion") {
                    $log->create($request->all());
                    $log->save();
                
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
            } elseif ($request->type === "Dar de baja") {
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $logs = ModelsLogs::all();
        $total_records = count($logs);
        $counter = 1;
        $number_records_characteristics = 1;
        for ($i = 1; $i <= $total_records; $i++) {
            $current_records = ModelsLogs::where('id', $i)->first();
            $array_characteristics = explode('=>', $current_records->characteristics);
            foreach ($array_characteristics as $word) {
                if ($counter == 1 or $counter % 6 == 0) {
                    $response_characteristics[$counter] = $number_records_characteristics;
                    $counter++;
                    $response_characteristics[$counter] = $word;
                    $number_records_characteristics++;
                } else {
                    $response_characteristics[$counter] = $word;
                }
                $counter++;
            }
        }

        return response()->json([
            $logs,
            'Todas las caracteristicas, segun el id al registro que pertenecen, listas para ser mostradas' => $response_characteristics
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
