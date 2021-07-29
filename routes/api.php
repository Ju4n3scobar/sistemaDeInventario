<?php

use App\Http\Controllers\APIs\inventory;
use App\Http\Controllers\APIs\logs;
use App\Http\Controllers\APIs\Logs\ChangeCharacteristics;
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

Route::put('updateInventory', [inventory::class, 'update'])->name('updateInventory');

Route::post('storeLogs', [logs::class, 'store'])->name('storeLogs');

Route::get('showCharacteristics', [logs::class, 'returnCharacteristics']);

Route::post('changeCharacteristics', [ChangeCharacteristics::class, 'changeCharacteristics']);

Route::get('showLogs', [logs::class, 'show']);

