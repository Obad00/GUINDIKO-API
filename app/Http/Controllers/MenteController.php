<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenteRequest;
use App\Http\Requests\UpdateMenteRequest;
use Spatie\Permission\Models\Role;

class MenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentes = Mente::all();
        return $this-> customJsonResponse("Voici la liste de vos Mentees", $mentes);
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
    public function store(StoreMenteRequest $request)
 {
    //     $mente = Mente::create($request->all());
    //     return $this->customJsonResponse("Mentee créé avec succès", $mente);

    // $mente = new Mente();
    // $mente->fill($request->validated());
    // $mente->save();
    // return $this->customJsonResponse("mente créé avec succès", $mente, 201);
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
        return response()->json(['error' => 'Échec de la création de l"utilisateur'], 500);
    }
    $user->roles()->attach(Role::where('name', 'menti')->first());

    // Création du mente avec l'utilisateur associé
    $mente = Mente::create([
        'user_id' => $user->id,
        'motivation' => $request->motivation,
        'NiveauEtude' => $request->NiveauEtude, // Associe l'utilisateur au mente
    ]);

    // Vérifier si le mente est créé
    if (!$mente) {
        return response()->json(['error' => 'Échec de la création du mente'], 500);
    }

    // Retourner une réponse avec les données créées
    return response()->json(["Mente créé avec succes",'mente' => $mente, 'user' => $user], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Mente $mente)
    {
        return $this->customJsonResponse("Mentee récupéré avec succès", $mente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mente $mente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenteRequest $request, Mente $mente)
    {
        // Mise à jour des informations du User associé
        $user = $mente->user;
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'numeroTelephone' => $request->numeroTelephone,
            'email' => $request->email,
        ]);

        // Vous pouvez également mettre à jour les champs spécifiques à Mente si nécessaire
        // $mente->update($request->validated());

        return response()->json(['message' => 'Mentee modifié avec succès', 'mente' => $mente], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mente $mente)
    {
        // $mente->delete();
        // return $this->customJsonResponse("Mentee supprimé avec succès", 200);
         // Vérifier si l'utilisateur connecté est celui qui possède le compte
         if (Auth::id() !== $mente->user_id) {
            return response()->json(['error' => 'Vous ne pouvez pas supprimer un compte qui n\'est pas le vôtre'], 403);
        }

        // Supprimer le mentee et l'utilisateur associé
        $mente->delete();
        $mente->user()->delete();

        return $this->customJsonResponse("Compte supprimé avec succès", null, 200);
    }
}
