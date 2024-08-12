<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PostForumController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\CommentaireForumController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenteController;
use App\Http\Controllers\DemandeMentoratController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');






Route::apiResource('roles', RoleController::class);
Route::apiResource('permissions', PermissionController::class);
Route::apiResource('users', UserController::class);

Route::patch('/users/{user}/activation', [UserController::class, 'updateActivation']);


Route::resource('forums', ForumController::class);
Route::apiResource('mentors', MentorController::class);
Route::patch('/mentors/{id}/activate', [MentorController::class, 'activate']);
Route::patch('/mentors/{id}/deactivate', [MentorController::class, 'deactivate']);
Route::apiResource('postes', PostForumController::class);
Route::apiResource('rdv', RendezVousController::class);
Route::apiResource('commentaires', CommentaireForumController::class);


Route::apiResource('demandes', DemandeMentoratController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

Route::apiResource('mentes', MenteController::class)->only('index', 'store', 'show','update','destroy');

// Route::apiResource('demandes', DemandeMentoratController::class)->only('index', 'store', 'show','destroy','update');

