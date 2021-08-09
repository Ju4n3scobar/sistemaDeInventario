<?php namespace App\Http\Services;

use App\Http\Controllers\APIs\logs;
use App\Http\Requests\requestStoreLogs;
use App\Models\Logs as ModelsLogs;

class RegisterEquipment 
{
    public function registerEquipment(requestStoreLogs $request)
    {
        $log_model = new ModelsLogs;
        $search_inventory_id = $request->inventory_id;
            $search_log_type = 'Registrar';
            $consult_response = ModelsLogs::where(function ($query) use ($search_log_type, $search_inventory_id) {
                $query->where('type', $search_log_type)
                    ->where('inventory_id', $search_inventory_id);
            })->get();
            if (sizeof($consult_response) == 0) {

                $log_model->type = "Registrar";
                $log_model->user = $request->user;
                $log_model->characteristics = json_encode($request->characteristics);
                $log_model->employee = $request->employee;
                $log_model->reason = $request->reason;
                $log_model->inventory_id = $request->inventory_id;
                $log_model->save();
                return $log_model;
        }
    }
}  

