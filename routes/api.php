<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PostForumController;
use App\Http\Controllers\CommentaireForumController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenteController;
use App\Http\Controllers\DemandeMentoratController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RendezVousController;


// Routes pour l'authentification
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Group routes that require authentication
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    // Routes pour les utilisateurs
    Route::apiResource('users', UserController::class);
    Route::patch('/users/{user}/activation', [UserController::class, 'updateActivation']);
    Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole']);

    // Routes pour les rôles et permissions
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::post('/roles/{id}/assign-permission', [RoleController::class, 'assignPermission']);
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions']);

    // Routes pour les mentors
    Route::apiResource('mentors', MentorController::class);
    Route::patch('/mentors/{id}/activate', [MentorController::class, 'activate']);
    Route::patch('/mentors/{id}/deactivate', [MentorController::class, 'deactivate']);

    // Routes pour les forums
    Route::resource('forums', ForumController::class);

    // Routes pour les postes et commentaires du forum
    Route::apiResource('postes', PostForumController::class);
    Route::apiResource('commentaires', CommentaireForumController::class);

    // Routes pour les rendez-vous et demandes de mentorat
    Route::apiResource('rdv', RendezVousController::class);
    Route::apiResource('demandes', DemandeMentoratController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::get('/demandes-acceptee', [DemandeMentoratController::class, 'getAcceptedRequestsForMentor']);

    // Routes pour les mentees
    Route::apiResource('mentes', MenteController::class)->only('index', 'store', 'show', 'update', 'destroy');
    Route::get('/mente/by-user/{userId}', [MenteController::class, 'getByUserId']);
    Route::get('/admin/by-user/{userId}', [AdminController::class, 'getByUserId']);
    Route::get('/mentor/by-user/{userId}', [MentorController::class, 'getByUserId']);
});
