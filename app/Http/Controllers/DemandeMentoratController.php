<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use App\Models\DemandeMentorat;
use App\Http\Requests\StoreDemandeMentoratRequest;
use App\Http\Requests\UpdateDemandeMentoratRequest;

class DemandeMentoratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demandes = DemandeMentorat::all();
        return $this->customJsonResponse("Voici la liste de vos demandes de mentorat", $demandes);

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
    // public function store(StoreDemandeMentoratRequest $request)
    // {
    //     $demande = DemandeMentorat::create($request->validated());
    //     return $this->customJsonResponse("Demande de mentorat créée avec succès", $demande, 201);
    // }

    public function store(StoreDemandeMentoratRequest $request)
    {
        // Récupérer l'utilisateur connecté (on suppose qu'il est authentifié)
        $user = $request->user(); // Ou $request->user() si vous utilisez Laravel Sanctum ou Passport

        // Vérifier si le mentor existe
        $mentor = Mentor::find($request->mentor_id);

        if (!$mentor) {
            return response()->json(['error' => 'Le mentor choisi n\'existe pas'], 404);
        }

        // Création de la demande de mentorat
        $demande = DemandeMentorat::create([
            'user_id' => $user->id,
            'mentor_id' => $mentor->id,
            'statut' => $request->statut ?? 'En attente',  // Par défaut 'En attente' si non spécifié
        ]);

        // Vérifier si la demande de mentorat est créée
        if (!$demande) {
            return response()->json(['error' => 'Échec de la création de la demande de mentorat'], 500);
        }

        // Retourner une réponse avec les données créées
        return response()->json(['message' => 'Demande de mentorat créée avec succès', 'demande' => $demande], 201);
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(DemandeMentorat $demandeMentorat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeMentorat $demandeMentorat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeMentoratRequest $request, DemandeMentorat $demandeMentorat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeMentorat $demandeMentorat)
    {
        $demandeMentorat->delete();
        return $this->customJsonResponse("Livre supprimé avec succès",null, 200);
    }
}
