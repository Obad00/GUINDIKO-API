<?php


use App\Http\Controllers\MenteController;
use Illuminate\Support\Facades\Route;  // Importation de la façade Route pour définir des routes dans l'application Laravel.
use Illuminate\Support\Facades\Mail;   // Importation de la façade Mail pour envoyer des emails dans l'application Laravel.
use App\Mail\MentorAccepte;            // Importation de la classe MentorAccepte, représentant un email que l'on envoie lorsqu'une demande de mentorat est acceptée.
use App\Mail\MentorRefuse;             // Importation de la classe MentorRefuse, représentant un email que l'on envoie lorsqu'une demande de mentorat est refusée.
use App\Http\Controllers\DemandeMentoratController;



use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});


// Route::resource('mentes', MenteController::class)->only('index', 'store','show');




Route::middleware('api')->group(function () {

});








// Définition d'une route de test pour l'envoi d'un email lorsque la demande de mentorat est acceptée.
// Quand l'utilisateur accède à l'URL '/test-email-accepte', un email est envoyé à l'adresse 'test@example.com' utilisant la classe 'MentorAccepte'.
// Ensuite, le message 'Demande de mentorat acceptée avec succès !' est retourné en tant que réponse.
Route::get('/test-email-accepte', function () {
    Mail::to('bassinen13@gmail.com')->send(new MentorAccepte());  // Envoi de l'email avec le contenu défini dans la classe 'MentorAccepte'.
    return 'Demande de mentorat acceptée avec succès !';      // Message retourné à l'utilisateur après l'envoi de l'email.
});


// Définition d'une route de test pour l'envoi d'un email lorsque la demande de mentorat est refusée.
// Quand l'utilisateur accède à l'URL '/test-email-refuse', un email est envoyé à l'adresse 'test@example.com' utilisant la classe 'MentorRefuse'.
// Ensuite, le message 'Demande de mentorat refusé !' est retourné en tant que réponse.
Route::get('/test-email-refuse', function () {
    Mail::to('bassinen13@gmail.com')->send(new MentorRefuse());  // Envoi de l'email avec le contenu défini dans la classe 'MentorRefuse'.
    return 'Demande de mentorat refusé !';                  // Message retourné à l'utilisateur après l'envoi de l'email.
});

Route::apiResource('notifications', NotificationController::class);

