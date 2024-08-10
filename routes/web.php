<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\MentorAccepte;
use App\Mail\MentorRefuse;



Route::get('/', function () {
    return view('welcome');
});




Route::get('/test-email-accepte', function () {
    Mail::to('test@example.com')->send(new MentorAccepte());
    return 'Demande de mentorat acceptée avec succès !';
});

Route::get('/test-email-refuse', function () {
    Mail::to('test@example.com')->send(new MentorRefuse());
    return 'Demande de mentorat refusé !';
});


