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

    public function assignmentModelRequest(requestStoreLogs $request)
    {

        $log_model = new ModelsLogs();
        if ($request->type === "Registrar") {
            $log_model->type = "Registrar";
            $log_model->user = $request->user;
            $log_model->characteristics = $request->characteristics;
            $log_model->employee = $request->employee;
            $log_model->reason = $request->reason;
            $log_model->inventory_id = $request->inventory_id;

            $log_model->save();
            return $log_model;
        } else if ($request->type === "Actualizar") {

            $log_model->type = "Actualizar";
            $log_model->user = $request->user;
            $log_model->characteristics = $request->characteristics;
            $log_model->employee = $request->employee;
            $log_model->reason = $request->reason;
            $log_model->inventory_id = $request->inventory_id;

            $log_model->save();
            return $log_model;
        } else if ($request->type === "Reasignar") {
            $log_model->type = "Reasignar";
            $log_model->user = $request->user;
            $log_model->characteristics = $request->characteristics;
            $log_model->employee = $request->employee;
            $log_model->reason = $request->reason;
            $log_model->inventory_id = $request->inventory_id;

            $log_model->save();
            return $log_model;
        }
    }

    public function show()
    {
        $logs = ModelsLogs::all();
        $total_records = count($logs);
        $counter = 1;
        for ($i = 1; $i <= $total_records; $i++) {
            $current_records = ModelsLogs::where('id', $i)->get();
            if(isset($current_records->characteristics)){
                $array_characteristics = explode('=>', $current_records->characteristics);
                foreach ($array_characteristics as $word) {
                    
                    $key_value_characteristics = explode('=>', $current_records['characteristics']);

                            $characteristics_response[$key_value_characteristics[0]] = $key_value_characteristics[1];
                            $characteristics_response[$key_value_characteristics[2]] = $key_value_characteristics[3];
                            $counter++; 
                            
                            // $characteristics_response[$counter]=$key_value_characteristics[1];
                                
                           
                            // $characteristics_response[$counter]=$key_value_characteristics[1];
                    
                    
                    // if ($counter == 1 or $counter % 6 == 0) {
                    //     $response_characteristics[$counter] = $number_records_characteristics;
                    //     $counter++;
                    //     $response_characteristics[$counter] = $word;
                    //     $number_records_characteristics++;
                    // } else {
                    //     $response_characteristics[$counter] = $word;
                    // }
                    // $counter++;
                }
                
            }
            
        }

        return response()->json([
            $logs,
            'Todas las caracteristicas, segun el id al registro que pertenecen, listas para ser mostradas' => $characteristics_response
        ]);
    }
}