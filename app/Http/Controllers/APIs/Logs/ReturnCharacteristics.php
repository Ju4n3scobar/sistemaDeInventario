<?php

namespace App\Http\Controllers\APIs\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnCharacteristics extends Controller
{

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

}
