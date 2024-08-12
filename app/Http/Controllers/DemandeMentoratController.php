<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemandeMentoratRequest;
use App\Http\Requests\UpdateDemandeMentoratRequest;
use App\Models\User;
use App\Models\Mente;
use App\Models\Mentor;
use App\Models\DemandeMentorat;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DemandeMentoratController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier le rôle de l'utilisateur et filtrer les demandes en conséquence
        if ($user->hasRole('mentor')) {

            // Récupérer le Mente associé à l'utilisateur connecté
            $mentor = Mentor::where('user_id', $user->id)->first();

            // Si l'utilisateur est un mentor, récupérer les demandes où l'utilisateur est le mentor
            $demandes = DemandeMentorat::where('mentor_id', $mentor->id)->get();
        } elseif ($user->hasRole('menti')) {

            // Récupérer le Mente associé à l'utilisateur connecté
            $mente = Mente::where('user_id', $user->id)->first();
            // Si l'utilisateur est un mentee, récupérer les demandes où l'utilisateur est le mentee
            $demandes = DemandeMentorat::where('mente_id', $mente->id)->get();
        } else {
            // Pour tout autre rôle ou si aucun rôle ne correspond, ne renvoyer aucune demande ou gérer autrement
            $demandes = collect(); // retourne une collection vide
        }

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

    public function store(StoreDemandeMentoratRequest $request)
    {
        // Récupérer l'utilisateur connecté
        $user = $request->user();

        // Récupérer le Mente associé à l'utilisateur connecté
        $mente = Mente::where('user_id', $user->id)->first();

        // Vérifier si le Mente existe
        if (!$mente) {
            return response()->json(['error' => 'Aucun mente associé à cet utilisateur'], 404);
        }

        // Vérifier si le mentor existe
        $mentor = Mentor::find($request->mentor_id);

        if (!$mentor) {
            return response()->json(['error' => 'Le mentor choisi n\'existe pas'], 404);
        }
        // Création de la demande de mentorat
        $demande = DemandeMentorat::create([
            'mente_id' => $mente->id, // Utilisez l'ID du Mente
            'mentor_id' => $mentor->id,
        ]);

        // Vérifier si la demande de mentorat est créée
        if (!$demande) {
            return response()->json(['error' => 'Échec de la création de la demande de mentorat'], 500);
        }

        // Création de la notification
        $notification = Notification::create([
            'objet' => 'Nouvelle demande de mentorat',
            'contenu' => "Une nouvelle demande de mentorat a été créée par l'utilisateur {$user->nom} pour le mentor {$mentor->user->nom}.",
            'demande_mentorat_id' => $demande->id,
        ]);

        return response()->json([
            'message' => 'Demande de mentorat créée avec succès',
            'demande' => $demande,
            'notification' => $notification,
        ], 201);
    }

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
    public function update(UpdateDemandeMentoratRequest $request, $id)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier que l'utilisateur connecté est un mentor
    $mentor = Mentor::where('user_id', $user->id)->first();

    if (!$mentor) {
        return response()->json(['error' => 'Utilisateur non autorisé'], 403);
    }

    // Récupérer la demande de mentorat
    $demande = DemandeMentorat::find($id);
    if (!$demande) {
        return response()->json(['error' => 'Demande de mentorat non trouvée'], 404);
    }

    // Vérifier que la demande appartient au mentor
    if ($demande->mentor_id != $mentor->id) {
        return response()->json(['error' => 'Cette demande de mentorat ne vous appartient pas'], 403);
    }

    // La validation est déjà faite par UpdateDemandeMentoratRequest
    $validated = $request->validated();

    // Mettre à jour la demande de mentorat
    $demande->update($validated);

    // Création de la notification pour le mente
    $mente = Mente::find($demande->mente_id);
    if ($mente) {
        Notification::create([
            'objet' => 'Mise à jour de la demande de mentorat',
            'contenu' => "Votre demande de mentorat a été {$demande->statut} par le mentor {$mentor->user->nom}.",
            'demande_mentorat_id' => $demande->id,
        ]);
    }

    return response()->json([
        'message' => 'Demande de mentorat mise à jour avec succès',
        'demande' => $demande,
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeMentorat $demandeMentorat)
    {
        $demandeMentorat->delete();
        return $this->customJsonResponse("Demande supprimé avec succès", null, 200);
    }
}
