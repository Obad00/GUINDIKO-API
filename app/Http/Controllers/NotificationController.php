<?php

namespace App\Http\Controllers;

use App\Models\Mente;
use App\Models\Mentor;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Affiche la liste des notifications.
     * Afficher la liste de toutes les notifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */public function index()
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Déterminer les notifications à afficher en fonction du rôle de l'utilisateur
    if ($user->hasRole('admin')) {
        // L'administrateur voit toutes les notifications
        $notifications = Notification::all();
    } elseif ($user->hasRole('mentor')) {
        // Récupérer l'ID du mentor associé à l'utilisateur
        $mentor = Mentor::where('user_id', $user->id)->first();

        if (!$mentor) {
            return response()->json(['error' => 'Mentor non trouvé'], 404);
        }

        // Les mentors voient les notifications associées à leurs demandes de mentorat ou à leurs rendez-vous
        $notifications = Notification::where(function ($query) use ($mentor) {
            $query->whereIn('demande_mentorat_id', function ($subQuery) use ($mentor) {
                $subQuery->select('id')
                         ->from('demande_mentorats')
                         ->where('mentor_id', $mentor->id);
            })
            ->orWhereIn('rendez_vous_id', function ($subQuery) use ($mentor) {
                $subQuery->select('id')
                         ->from('rendez_vouses')
                         ->where('mentor_id', $mentor->id);
            });
        })->get();
    } elseif ($user->hasRole('menti')) {
        // Récupérer l'ID du mente associé à l'utilisateur
        $mente = Mente::where('user_id', $user->id)->first();

        if (!$mente) {
            return response()->json(['error' => 'Mente non trouvé'], 404);
        }

        // Les mentees voient les notifications associées à leurs demandes de mentorat
        $notifications = Notification::whereIn('demande_mentorat_id', function ($subQuery) use ($mente) {
            $subQuery->select('id')
                     ->from('demande_mentorats')
                     ->where('mente_id', $mente->id);
        })->get();
    } else {
        // Si l'utilisateur n'a aucun rôle connu, retourner une erreur ou une réponse vide
        return response()->json(['error' => 'Role inconnu'], 403);
    }

    // Log de la récupération des notifications
    Log::info('Liste des notifications récupérées pour l\'utilisateur ID : ' . $user->id);

    // Vérifier si les notifications sont vides et retourner un message approprié
    if ($notifications->isEmpty()) {
        return response()->json(['message' => 'Aucune notification disponible pour cet utilisateur.']);
    }

    return response()->json($notifications);
}





    /**
     * Stocke une nouvelle notification.
     */

    public function store(Request $request)
    {
        // Valider les données de la requête
        $validated = $request->validate([
            'objet' => 'required|string|max:255', // Champ obligatoire, de type chaîne de caractères, avec une longueur maximale de 255 caractères
            'contenu' => 'required|string',       // Champ obligatoire et de type chaîne de caractères
            'demande_mentorat_id' => 'nullable|exists:demande_mentorats,id', // Champ optionnel mais doit exister dans la table demande_mentorats
            'rendez_vous_id' => 'nullable|exists:rendez_vouses,id',          // Champ optionnel mais doit exister dans la table rendez_vouses
        ]);

        // Créer la notification avec les données validées
        $notification = Notification::create($validated);
        Log::info('Nouvelle notification créée :', $validated);
        return response()->json($notification, 201);
    }

    /**
     * Affiche les détails d'une notification spécifique.
     */

    public function show(Notification $notification)
    {
        Log::info('Notification récupérée :', ['id' => $notification->id]);
        return response()->json($notification);
    }

    /**
     * Met à jour une notification existante.
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'demande_mentorat_id' => 'nullable|exists:demande_mentorat,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
            'status' => 'required|string',
            'message' => 'required|string',
        ]);

        $notification->update($validated);
        return response()->json($notification);
    }

    /**
     * Supprime une notification.
     * Supprimer la notification spécifiée.
     *
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        Log::info('Notification supprimée :', ['id' => $notification->id]);
        return response()->json(null, 204);
    }
}
