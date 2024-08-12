<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    try {
        // Tentative d'authentification et obtention du jeton
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Authentifie l'utilisateur avec le jeton
        $user = JWTAuth::setToken($token)->authenticate();

        // Si l'utilisateur n'est pas trouvé après authentification
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Récupère les rôles de l'utilisateur
        $roles = $user->roles->pluck('name');

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'roles' => $roles,
            ]
        ]);
    } catch (JWTException $e) {
        // Gestion des erreurs lors de la création du jeton
        return response()->json(['error' => 'Could not create token', 'exception' => $e->getMessage()], 500);
    }
}


    public function register(Request $request)
    {
        // Logique d'enregistrement
    }

    public function logout(Request $request)
{
    try {
        // Invalider le jeton JWT
        JWTAuth::parseToken()->invalidate();

        return response()->json(['message' => 'Successfully logged out'], 200);
    } catch (JWTException $e) {
        return response()->json(['error' => 'Failed to logout', 'exception' => $e->getMessage()], 500);
    }
}

}
