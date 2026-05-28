<?php

use App\Http\Controllers\PcInventoryController;
use App\Models\PcInventory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.admin');
})->name("home");

Route::resource('pcinventories',PcInventory::class);
Route::post('/pcinventories/massCreate',[PcInventoryController::class,'massCreate'])->name("pcinventories.massCreate");