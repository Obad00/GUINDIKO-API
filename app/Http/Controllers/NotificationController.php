<?php

namespace App\Http\Controllers;

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
     */
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Déterminer les notifications à afficher en fonction du rôle de l'utilisateur
        if ($user->hasRole('admin')) {
            // L'administrateur voit toutes les notifications
            $notifications = Notification::all();
        } elseif ($user->hasRole('mentor')) {
            // Les mentors voient les notifications associées à leurs demandes de mentorat ou à leurs rendez-vous
            $notifications = Notification::where('demande_mentorat_id', function($query) use ($user) {
                $query->select('id')
                    ->from('demande_mentorats')
                    ->where('mentor_id', $user->id);
            })->orWhere('rendez_vous_id', function($query) use ($user) {
                $query->select('id')
                    ->from('rendez_vouses')
                    ->where('mentor_id', $user->id);
            })->get();
        } elseif ($user->hasRole('menti')) {
            // Les mentees voient les notifications associées à leurs demandes de mentorat
            $notifications = Notification::where('demande_mentorat_id', function($query) use ($user) {
                $query->select('id')
                    ->from('demande_mentorats')
                    ->where('mente_id', $user->id);
            })->get();
        } else {
            // Si l'utilisateur n'a aucun rôle connu, retourner une erreur ou une réponse vide
            return response()->json(['error' => 'Role inconnu'], 403);
        }

        Log::info('Liste des notifications récupérées pour l\'utilisateur ID : ' . $user->id);
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
