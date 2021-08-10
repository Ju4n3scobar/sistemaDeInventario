<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIs\Logs\ReassignEquipment;
use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use App\Http\Services\ChangeCharacteristics;
use App\Http\Services\RegisterEquipment;
use App\Models\Logs as ModelsLogs;
use stdClass;

class logs extends Controller
{

    public function assignmentModelRequest(requestStoreLogs $request)
    {

        $log_model = new ModelsLogs();
        if ($request->type === "Actualizar") {
            $change_characteristics_class = new ChangeCharacteristics();
            $change_characteristics_exe = $change_characteristics_class->changeCharacteristics($request);
            if($change_characteristics_exe){
                    return response()->json([
                        $change_characteristics_exe
                    ], 201);
            }

        //     $log_model->type = "Registrar";
        //     $log_model->user = $request->user;
        //     $log_model->characteristics = json_encode($request->characteristics);
        //     $log_model->employee = $request->employee;
        //     $log_model->reason = $request->reason;
        //     $log_model->inventory_id = $request->inventory_id;

        //     $log_model->save();
        //     return $log_model;

        } else if ($request->type === "Registrar") {
            $register_equipment_class = new RegisterEquipment();
            $register_equipment_exe = $register_equipment_class->registerEquipment($request);
            if($register_equipment_exe){
                    return response()->json([
                        'Response' => 'Equipo actualizado correctamente',
                        $register_equipment_exe
                    ], 201);
            }
            
        } else if ($request->type === "Reasignar") {
            $reassign_equipment_class = new ReassignEquipment();
            $reassign_equipment_exe = $reassign_equipment_class->reassignEquipment($request);
            if($reassign_equipment_exe){
                    return response()->json([
                        'Response' => 'Equipo actualizado correctamente',
                        $reassign_equipment_exe
                    ], 201);
            }
        }
    }
    public function show()
    {
        $logs = ModelsLogs::all();
        $total_records = count($logs);
        $counter = 1;
        for ($i = 1; $i <= $total_records; $i++) {
            $current_records = ModelsLogs::where('id', $i)->first();
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
            $characteristics_response
        ]);
    
    }
}

