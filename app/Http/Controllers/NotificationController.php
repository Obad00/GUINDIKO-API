<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'objet' => 'required|string',
            'contenu' => 'required|string',
            'demande_mentorat_id' => 'nullable|exists:demande_mentorat,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
        ]);

        $notification = Notification::create($validated);
        return response()->json($notification, 201);
    }

    public function show(Notification $notification)
    {
        return response()->json($notification);
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'objet' => 'required|string',
            'contenu' => 'required|string',
            'demande_mentorat_id' => 'nullable|exists:demande_mentorat,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
        ]);

        $notification->update($validated);
        return response()->json($notification);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }
}
