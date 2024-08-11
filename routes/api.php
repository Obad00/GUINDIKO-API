<?php

use App\Http\Controllers\MentorController;
use App\Http\Controllers\PostForumController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('mentors', MentorController::class);
Route::patch('/mentors/{id}/activate', [MentorController::class, 'activate']);
Route::patch('/mentors/{id}/deactivate', [MentorController::class, 'deactivate']);
Route::apiResource('postes', PostForumController::class);
Route::apiResource('rdv', RendezVousController::class);
