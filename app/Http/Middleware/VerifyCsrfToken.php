<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Les URIs qui devraient être exclues de la vérification CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*',
        'webhook/*', // Exemple pour les webhooks
    ];
}
