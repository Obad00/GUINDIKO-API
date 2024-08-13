<?php

namespace App\Http\Controllers;

use App\Models\Mente;
use App\Models\Mentor;
use App\Models\RendezVous;
use App\Models\Notification;
use App\Mail\MenteRendezVousMail;
use App\Mail\MentorRendezVousMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreRendezVousRequest;
use App\Http\Requests\UpdateRendezVousRequest;


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
        // Récupérer l'utilisateur connecté (qui est un mentor)
        $user = Auth::user();
        $mentor = Mentor::where('user_id', $user->id)->first();
    
        // Créer le rendez-vous
        $rendezVous = RendezVous::create([
            'sujet' => $request->sujet,
            'date_rendezVous' => $request->date_rendezVous,
            'lieu' => $request->lieu,
            'type' => $request->type,
            'durée' => $request->durée,
            'lien' => $request->lien,
            'statut' => $request->statut,
            'mentor_id' => $mentor->id,
            'mente_id' => $request->mente_id,
        ]);
    
        // Envoyer le mail au mentor
        Mail::to($mentor->user->email)->send(new MentorRendezVousMail($rendezVous));
    
        // Envoyer le mail au mente
        $mente = Mente::find($request->mente_id);
        if ($mente) {
            Mail::to($mente->user->email)->send(new MenteRendezVousMail($rendezVous));
        }
    
        // Créer la notification pour le mentor
        Notification::create([
            'objet' => 'Nouveau Rendez-vous créé',
            'contenu' => "Un nouveau rendez-vous a été créé par le mentor {$mentor->user->nom} pour le mentee {$mente->user->nom}.",
            'rendez_vous_id' => $rendezVous->id,
        ]);
    
        // Créer la notification pour le mente
        Notification::create([
            'objet' => 'Vous avez un nouveau rendez-vous',
            'contenu' => "Le mentor {$mentor->user->nom} a programmé un rendez-vous avec vous pour le sujet: {$rendezVous->sujet}.",
            'rendez_vous_id' => $rendezVous->id,
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
        // Récupérer l'utilisateur connecté (qui est un mentor)
        $user = Auth::user();
        $mentor = Mentor::where('user_id', $user->id)->first();
    
        if (!$mentor) {
            return response()->json(['error' => 'Utilisateur non autorisé'], 403);
        }
    
        // Récupérer le rendez-vous
        $rendezVous = RendezVous::findOrFail($id);
    
        // Vérifier que le rendez-vous appartient au mentor connecté
        if ($rendezVous->mentor_id != $mentor->id) {
            return response()->json(['error' => 'Vous n\'êtes pas autorisé à modifier ce rendez-vous'], 403);
        }
    
        // Mettre à jour le rendez-vous
        $rendezVous->update($request->all());
    
        // Envoyer le mail de mise à jour au mente
        $mente = Mente::find($rendezVous->mente_id);
        if ($mente) {
            Mail::to($mente->user->email)->send(new MenteRendezVousMail($rendezVous));
        }
    
        // Créer la notification pour le mentor
        Notification::create([
            'objet' => 'Rendez-vous mis à jour',
            'contenu' => "Le rendez-vous pour le sujet: {$rendezVous->sujet} a été mis à jour par le mentor {$mentor->user->nom}.",
            'rendez_vous_id' => $rendezVous->id,
        ]);
    
        // Créer la notification pour le mente
        Notification::create([
            'objet' => 'Votre rendez-vous a été mis à jour',
            'contenu' => "Votre rendez-vous avec le mentor {$mentor->user->nom} pour le sujet: {$rendezVous->sujet} a été mis à jour.",
            'rendez_vous_id' => $rendezVous->id,
        ]);
    
        return response()->json($rendezVous);
    }
    


    public function destroy($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->delete();

        return response()->json(null, 204);
    }
}
