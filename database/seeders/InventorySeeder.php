<?php

namespace Database\Seeders;

use App\Models\Inventory as ModelsInventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventory = new ModelsInventory();
        $inventory->user= "Juan";
        $inventory->name = "CPU";
        $inventory->classification = "Computador";
        $inventory->reference = "1234";
        $inventory->status = true;
        $inventory->price = "100000";
        $inventory->save();
    }
}
