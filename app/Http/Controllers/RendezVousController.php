<?php

namespace App\Http\Controllers;

use App\Models\Mente;
use App\Models\Mentor;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRendezVousRequest;
use App\Http\Requests\UpdateRendezVousRequest;
use Illuminate\Support\Facades\Auth;


class RendezVousController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est un mentor
        $mentor = Mentor::where('user_id', $user->id)->first();

        if ($mentor) {
            // Si l'utilisateur est un mentor, récupérer tous les rendez-vous où le mentor est impliqué
            $rendezVous = RendezVous::where('mentor_id', $mentor->id)->get();
        } else {
            // Si l'utilisateur n'est pas un mentor, supposer qu'il est un mente
            $mente = Mente::where('user_id', $user->id)->first();

            if ($mente) {
                // Récupérer tous les rendez-vous où le mente est impliqué
                $rendezVous = RendezVous::where('mente_id', $mente->id)->get();
            } else {
                // Si l'utilisateur n'est ni mentor ni mente, retourner un tableau vide ou un message d'erreur
                return response()->json(['error' => 'Utilisateur non autorisé ou sans rendez-vous'], 403);
            }
        }

        return response()->json($rendezVous);
    }


    public function create()
    {
        // Not necessary for API
    }

    public function store(StoreRendezVousRequest $request)
    {
        // Récupérer l'utilisateur connecté
        $user = $request->user();

        // Vérifier si l'utilisateur est un mentor
        $mentor = Mentor::where('user_id', $user->id)->first();

        if (!$mentor) {
            return response()->json(['error' => 'Seuls les mentors peuvent créer un rendez-vous'], 403);
        }

        // Ajouter l'ID du mentor au rendez-vous
        $rendezVous = RendezVous::create([
            'sujet' => $request->sujet,
            'date_rendezVous' => $request->date_rendezVous,
            'lieu' => $request->lieu,
            'type' => $request->type,
            'durée' => $request->durée,
            'lien' => $request->lien,
            'statut' => $request->statut,
            'mentor_id' => $mentor->id, // Utiliser l'ID du mentor connecté
            'mente_id' => $request->mente_id,
        ]);

        return response()->json($rendezVous, 201);
    }



    public function show($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        return response()->json($rendezVous);
    }

    public function edit($id)
    {
        // Not necessary for API
    }

    public function update(UpdateRendezVousRequest $request, $id)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier que l'utilisateur est un mentor
        $mentor = Mentor::where('user_id', $user->id)->first();

        if (!$mentor) {
            return response()->json(['error' => 'Utilisateur non autorisé'], 403);
        }

        // Récupérer le rendez-vous
        $rendezVous = RendezVous::findOrFail($id);

        // Vérifier que le rendez-vous appartient bien au mentor connecté
        if ($rendezVous->mentor_id != $mentor->id) {
            return response()->json(['error' => 'Vous n\'êtes pas autorisé à modifier ce rendez-vous'], 403);
        }

        // Mettre à jour le rendez-vous avec les données validées
        $rendezVous->update($request->all());

        return response()->json($rendezVous);
    }


    public function destroy($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->delete();

        return response()->json(null, 204);
    }
}
