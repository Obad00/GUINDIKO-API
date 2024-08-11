<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;


Route::get('/', function () {
    return view('welcome');
});

// Route::apiResource('notifications', NotificationController::class);

Route::get('notifications', [NotificationController::class, 'index']);
Route::get('notifications/{id}', [NotificationController::class, 'show']);
Route::post('notifications', [NotificationController::class, 'store']);
Route::put('notifications/{id}', [NotificationController::class, 'update']);
Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);
