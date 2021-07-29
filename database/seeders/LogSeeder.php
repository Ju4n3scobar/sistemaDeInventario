<?php

namespace Database\Seeders;

use App\Models\Logs;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventory = new Logs();
        $inventory->type= "registro";
        $inventory->user = "Juan";
        $inventory->characteristics = "RAM=>8, Procesador=>Core i5";
        $inventory->employee = "Alberto";
        $inventory->reason = "Nuevo pc. El compañero no tiene equipo y por ende asignamos este";
        $inventory->inventory_id = "1";
        $inventory->save();
    }
}
