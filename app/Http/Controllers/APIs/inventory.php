<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestInsertInventory;
use App\Http\Requests\requestUpdateInventory;
use App\Models\Inventory as ModelsInventory;
use Illuminate\Http\Request;

class inventory extends Controller
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
    public function store(requestInsertInventory $request)
    {
        if(!$request->isJson()){
            return response()->json([
                'Error' => 'Inautorizado'
            ], 401);      
        }else{ 
            $inventory = ModelsInventory::create($request->all());

            return response()->json($inventory, 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsInventory $inventory)
    {   
        $inventory->get();
        return $inventory->all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(requestUpdateInventory $request)
    {
        $id = $request->id;
        ModelsInventory::where('id', $id)->update($request->all());

        $inventory= new ModelsInventory();
        return response()->json($inventory->all(), 201);
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
