<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::apiResource('roles', RoleController::class);
Route::apiResource('permissions', PermissionController::class);
Route::apiResource('users', UserController::class);

Route::patch('/users/{user}/activation', [UserController::class, 'updateActivation']);

