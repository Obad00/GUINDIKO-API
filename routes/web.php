<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DemandeMentoratController;


Route::get('/', function () {
    return view('welcome');
});





Route::middleware('auth:sanctum')->post('/demandes-mentorats', [DemandeMentoratController::class, 'store']);
Route::middleware('auth:sanctum')->get('/notifications', [NotificationController::class, 'index']);


// Route::get('notifications', [NotificationController::class, 'index']);
// Route::post('notifications', [NotificationController::class, 'store']);
// Route::get('notifications/{id}', [NotificationController::class, 'show']);
// Route::put('notifications/{id}', [NotificationController::class, 'update']);
// Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);



