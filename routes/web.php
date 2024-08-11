<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MenteController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::resource('mentes', MenteController::class)->only('index', 'store','show');


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenteController;
use App\Http\Controllers\DemandeMentoratController;

Route::middleware('api')->group(function () {

});
Route::resource('mentes', MenteController::class)->only('index', 'store', 'show');
Route::put('mentes/{mente}', [MenteController::class, 'update']);
Route::delete('mentes/{mente}', [MenteController::class, 'destroy']);
Route::get('mentes/{mente}', [MenteController::class, 'show']);
Route::post('mentes', [MenteController::class, 'store']);

Route::resource('demandes', DemandeMentoratController::class)->only('index', 'store', 'show');
