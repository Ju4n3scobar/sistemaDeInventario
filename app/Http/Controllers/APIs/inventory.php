<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestConsultInventory;
use App\Http\Requests\requestInsertInventory;
use App\Http\Requests\requestUpdateInventory;
use App\Models\Inventory as ModelsInventory;
use Illuminate\Http\Request;

class inventory extends Controller
{

    public function store(requestInsertInventory $request)
    {
        if(!$request->isJson()){
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);      
        }else{ 
            $inventory_model = ModelsInventory::create($request->all());

            return response()->json($inventory_model, 201);
        }

    }

    public function consult(requestConsultInventory $request, ModelsInventory $inventory_model)
    {
        $consult_inventory = $inventory_model->select('name')->where('id', $request->id);
        $inventory_response = $consult_inventory->first();
        return response()->json($inventory_response, 201);
        // if(!$request->isJson()){
        //     return response()->json([
        //         'Error' => 'Inautorizado'
        //     ], 401);      
        // }else{ 
        //     $inventory_model = ModelsInventory::create($request->all());

        //     return response()->json($inventory_model, 201);
        // }

    }

    public function show(ModelsInventory $inventory_model)
    {   
        $inventory_model->get();
        return $inventory_model->all();
    }
    
    public function update(requestUpdateInventory $request)
    {
        if(!$request->isJson()){
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);      
        }else{ 
            $id_reference = $request->id;
            ModelsInventory::where('id', $id_reference)->update($request->all());

            $inventory_model= new ModelsInventory();
            return response()->json($inventory_model->all(), 201);
        }
        
    }

}
