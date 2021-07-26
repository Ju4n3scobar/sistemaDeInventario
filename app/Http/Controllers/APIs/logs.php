<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestStoreLogs;
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
            $log = ModelsLogs::create($request->all());

            return response()->json($log, 201);
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
