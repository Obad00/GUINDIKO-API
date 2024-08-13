<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\Mente;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log; // Import Log facade


class UserController extends Controller
{
    public function index(): JsonResponse
    {
        // Charger les utilisateurs avec leurs rôles
        $users = User::with('roles')->get();

        // Mapper les rôles des utilisateurs pour le format JSON
        $usersWithRoles = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'numeroTelephone' => $user->numeroTelephone,
                'email' => $user->email,
                'roles' => $user->roles->pluck('name'),
            ];
        });

        return response()->json($usersWithRoles);
    }



public function store(StoreUserRequest $request): JsonResponse
{
    try {
        // Les données sont déjà validées par StoreUserRequest

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'numeroTelephone' => $request->numeroTelephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assignation du rôle
        $role = $request->role;

        if (Role::where('name', $role)->exists()) {
            $user->assignRole($role);
        } else {
            return response()->json(['error' => 'Role not found'], 404);
        }
        // Ajouter dans la table mentor ou mente en fonction du rôle
        if ($role === 'mentor') {
            // Debugging statement
            Log::info('Creating mentor with data:', [
                'user_id' => $user->id,
                'domaineExpertise' => $request->domaineExpertise,
                'experience' => $request->experience,
                'disponibilite' => $request->disponibilite,
            ]);

            Mentor::create([
                'user_id' => $user->id,
                'domaineExpertise' => $request->domaineExpertise,
                'experience' => $request->experience,
                'disponibilite' => $request->disponibilite,
            ]);

        } elseif ($role === 'menti') {
            // Debugging statement
            Log::info('Creating mente with data:', [
                'user_id' => $user->id,
                'motivation' => $request->motivation,
                'NiveauEtude' => $request->NiveauEtude,
            ]);

            Mente::create([
                'user_id' => $user->id,
                'motivation' => $request->motivation,
                'NiveauEtude' => $request->NiveauEtude,
            ]);
        }

        return response()->json($user, 201);

    } catch (\Exception $e) {
        // Capture les erreurs
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numeroTelephone' => 'required|numeric', // Utiliser 'numeric' pour accepter des chaînes contenant uniquement des chiffres
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        // Mise à jour de l'utilisateur
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'numeroTelephone' => $request->numeroTelephone,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // Mise à jour du rôle si nécessaire
        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function updateActivation(Request $request, User $user): JsonResponse
{
    // Validation des données d'entrée
    $request->validate([
        'is_active' => 'required|boolean',
    ]);

    // Mise à jour de l'état d'activation
    $user->is_active = $request->is_active;
    $user->save();

    return response()->json($user);
}

}
