<?php namespace App\Http\Services;

use App\Http\Controllers\APIs\logs;
use App\Http\Requests\requestStoreLogs;
use App\Models\Logs as ModelsLogs;

class RegisterEquipment 
{
        public function reassignEquipment(requestStoreLogs $request)
        {
            $log_model = new ModelsLogs;
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
