<?php

use App\Http\Controllers\APIs\inventory;
use App\Http\Controllers\APIs\logs;
use App\Http\Controllers\APIs\Logs\ChangeCharacteristics;
use App\Http\Controllers\APIs\Logs\ReassignEquipment;
use App\Http\Controllers\APIs\Logs\RegisterEquipment;
use App\Http\Controllers\APIs\Logs\ReturnCharacteristics;
use App\Models\Logs as ModelsLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('storeInventory', [inventory::class, 'store'])->name('insertInventory');

Route::get('showInventory', [inventory::class, 'show'])->name('listInventory');

Route::get('consultInventory', [inventory::class, 'consult'])->name('consultInventory');

Route::put('updateInventory', [inventory::class, 'update'])->name('updateInventory');


Route::post('changeCharacteristics', [logs::class, 'assignmentModelRequest']);

Route::post('reassignEquipment', [ReassignEquipment::class, 'reassignEquipment']);

Route::post('registerEquipment', [RegisterEquipment::class, 'registerEquipment']);

Route::get('showCharacteristics', [ReturnCharacteristics::class, 'returnCharacteristics']);

Route::get('showLogs', [logs::class, 'show']);


