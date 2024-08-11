<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Lister toutes les notifications
    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    // Afficher une notification spécifique
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return response()->json($notification);
    }

    // Créer une nouvelle notification
    public function store(Request $request)
    {
        $request->validate([
            'objet' => 'required|string',
            'contenu' => 'required|string',
            'demande_mentorat_id' => 'nullable|exists:demande_mentors,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
        ]);

        $notification = Notification::create($request->all());
        return response()->json($notification, 201);
    }

    // Mettre à jour une notification existante
    public function update(Request $request, $id)
    {
        $request->validate([
            'objet' => 'required|string',
            'contenu' => 'required|string',
            'demande_mentorat_id' => 'nullable|exists:demande_mentors,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
        ]);

        $notification = Notification::findOrFail($id);
        $notification->update($request->all());
        return response()->json($notification);
    }

    // Supprimer une notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Notification supprimée avec succès']);
    }
}
