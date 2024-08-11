<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Afficher la liste de toutes les notifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notifications = Notification::all();
        Log::info('Liste des notifications récupérée.');
        return response()->json($notifications);
    }

    /**
     * Stocker une nouvelle notification dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * Afficher la notification spécifiée.
     *
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Notification $notification)
    {
        Log::info('Notification récupérée :', ['id' => $notification->id]);
        return response()->json($notification);
    }

    /**
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
