<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use App\Http\Requests\StoreMentorRequest;
use App\Http\Requests\UpdateMentorRequest;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $mentor = Mentor::all();
    //     $user = $mentor->user;
    //     return response()->json(['mentor' => $mentor, 'user' => $user], 201);
    // }

                    public function index()
                {
                    // Charger les mentors avec les utilisateurs associés
                    $mentors = Mentor::with('user')->get(); // Précharge les utilisateurs associés aux mentors

                    // Mapper les mentors et les utilisateurs pour le format JSON
                    $mentorsWithUsers = $mentors->map(function ($mentor) {
                        return [
                            'mentor' => $mentor, // Données du mentor
                            'user' => $mentor->user // Utilisateur associé
                        ];
                    });

                    return response()->json($mentorsWithUsers, 200);
                }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMentorRequest $request)
    {
        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'numeroTelephone' => $request->numeroTelephone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Vérifier si l'utilisateur est créé
        if (!$user) {
            return response()->json(['error' => 'Échec de la création de l\'utilisateur'], 500);
        }

        // Création du mentor avec l'utilisateur associé
        $mentor = Mentor::create([
            'user_id' => $user->id,  // Associe l'utilisateur au mentor
            'domaineExpertise' => $request->domaineExpertise,
            'experience' => $request->experience,
            'disponibilite' => $request->disponibilite,
        ]);

        // Vérifier si le mentor est créé
        if (!$mentor) {
            return response()->json(['error' => 'Échec de la création du mentor'], 500);
        }

        // Retourner une réponse avec les données créées
        return response()->json(['mentor' => $mentor, 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mentor = Mentor::findOrFail($id);
        $user = $mentor->user;
        return response()->json(['mentor' => $mentor, 'user' => $user], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentor $mentor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMentorRequest $request, $id)
    {
        // Récupérer le mentor
        $mentor = Mentor::findOrFail($id);

        // Récupérer l'utilisateur associé
        $user = $mentor->user;

        // Vérifier que l'utilisateur existe
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'nom' => $request->input('nom', $user->nom),
            'prenom' => $request->input('prenom', $user->prenom),
            'numeroTelephone' => $request->input('numeroTelephone', $user->numeroTelephone),
            'email' => $request->input('email', $user->email),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        // Mise à jour des informations spécifiques au mentor
        $mentor->update([
            'domaineExpertise' => $request->input('domaineExpertise', $mentor->domaineExpertise),
            'experience' => $request->input('experience', $mentor->experience),
            'disponibilite' => $request->input('disponibilite', $mentor->disponibilite),
        ]);

        return response()->json([
            'user' => $user,
            'mentor' => $mentor,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->user->delete(); // Cela supprimera également le mentor grâce à la cascade

        return response()->json(null, 204);
    }

    public function activate($id)
{
    $mentor = Mentor::find($id);

    if (!$mentor) {
        return response()->json(['error' => 'Mentor non trouvé'], 404);
    }

    // Activer le mentor
    $mentor->disponibilite = true;
    $mentor->save();

    return response()->json(['message' => 'Mentor activé succès', 'mentor' => $mentor], 200);
}

public function deactivate($id)
{
    $mentor = Mentor::find($id);

    if (!$mentor) {
        return response()->json(['error' => 'Mentor non trouvé'], 404);
    }

    // Désactiver le mentor
    $mentor->disponibilite = false;
    $mentor->save();

    return response()->json(['message' => 'Mentor desactivé succès', 'mentor' => $mentor], 200);
}


}
