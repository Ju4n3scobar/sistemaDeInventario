<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
use App\Models\Inventory;
use App\Models\Logs as ModelsLogs;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requestStoreLogs $request)
    {
        if(!$request->isJson()){
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);      
        }else{ 
            if($request->tipo == "Registrar"){
                $inventory_id= $request->inventory_id;
                $tipo=$request->tipo;
                $dat =ModelsLogs::where(function ($query) use ($tipo,$inventory_id) {
                    $query->where('tipo', $tipo)
                          ->where('inventory_id', $inventory_id);
                  })->get();
                
                if($dat !== [] ){
                    // -----------------------------
                    // REALIZADO CON SHELL_EXEC
                    // ----------------------------
                    $cmd = shell_exec("systeminfo");
                    $respuesta1=utf8_encode($cmd);
                    $respuesta2 =str_replace(' ', '', $respuesta1);
                    $contenidoRemplazado = str_replace("\n", "," ,$respuesta2);
                    $arrayCharacteristics = explode ( ',', $contenidoRemplazado);
                    $contador=0;
                    foreach ( $arrayCharacteristics as $palabra ) {
                        $carac = explode ( ':', $palabra);
                        $contador++;
                        $respuesta[$contador]=$carac[0];
                        $contador++;
                        if(isset($carac[1])){
                            $respuesta[$contador]=$carac[1];
                        }else{
                            $carac[1]=' ';
                            $respuesta[$contador]=$carac[1];
                        }
                        
                    }
                    $respuestaString=implode ($respuesta);
                    $log = new ModelsLogs();

                    $log->tipo = "Registrar";
                    $log->user = $request->user;
                    $log->characteristics=$respuestaString;
                    $log->employee=$request->employee;
                    $log->motivo=$request->motivo;
                    $log->inventory_id=$request->inventory_id;
                    
                    $log->save();
                    
                    return response()->json([
                        $respuesta,
                        $log
                    ]);
                } else {
                    return response()->json([
                        'Error' => 'Este equipo ya fue registrado en el sistema con sus caracteristicas de fabrica'
                    ], 401);
                }
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
        // $totalRegistros = var_dump($logs->last());
        $consulta = ModelsLogs::select("id")->latest()->first();
        $ultimoRegistro = $consulta->id;
        for($i=1; $i<=$ultimoRegistro; $i++){
            $characteristics = $logs->where('id', $i)->first();
            $arrayCharacteristics = explode ( '=>', $characteristics->characteristics );
            foreach ( $arrayCharacteristics as $palabra=>$valor ) {
                $respuesta[$valor]=$palabra;
            }

            return response()->json([
                $respuesta
            ]);

            // for($z=2; $z<$contador; $z+2){
            //     $caracteristica=$z-2;
            //     $caracteristicaValor=$caracteristica;

            //     echo "Caracteristica => ". $arrayCharacteristics[$caracteristicaValor];
            //     // echo "Valor de la caracteristica => ". $arrayCharacteristics[$caracteristicaValor];
                

                
            // }

        
    }
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
