<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Affiche la liste des notifications.
     */
    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    /**
     * Stocke une nouvelle notification.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'demande_mentorat_id' => 'nullable|exists:demande_mentorat,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
            'status' => 'required|string',
            'message' => 'required|string',
        ]);

        $notification = Notification::create($validated);
        return response()->json($notification, 201);
    }

    /**
     * Affiche les détails d'une notification spécifique.
     */
    public function show(Notification $notification)
    {
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
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }
}
