<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Affiche une liste des ressources.
     */
    public function index(): JsonResponse
    {
        // Récupère toutes les notifications
        $notifications = Notification::all();
        // Retourne les notifications sous forme de réponse JSON
        return response()->json($notifications);
    }

    /**
     * Stocke une nouvelle ressource dans le stockage.
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        // Crée une nouvelle notification avec les données validées
        $notification = Notification::create($request->validated());
        // Retourne la notification créée avec un code de statut HTTP 201 (Créé)
        return response()->json($notification, 201);
    }

    /**
     * Affiche la ressource spécifiée.
     */
    public function show(Notification $notification): JsonResponse
    {
        // Retourne la notification spécifique sous forme de réponse JSON
        return response()->json($notification);
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        // Met à jour la notification avec les données validées
        $notification->update($request->validated());
        // Retourne la notification mise à jour
        return response()->json($notification);
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        // Supprime la notification
        $notification->delete();
        // Retourne une réponse vide avec un code de statut HTTP 204 (Pas de contenu)
        return response()->json(null, 204);
    }
}
