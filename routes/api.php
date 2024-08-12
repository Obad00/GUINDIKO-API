<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenteController;
use App\Http\Controllers\DemandeMentoratController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('mentes', MenteController::class)->only('index', 'store', 'show','update');

Route::apiResource('demandes', DemandeMentoratController::class)->only('index', 'store', 'show','destroy');
