<?php
namespace App\Http\Controllers;

use App\Models\DemandeMentorat;
use App\Models\Notification;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeMentoratController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mentor_id' => 'required|exists:mentors,id',
        ]);

        $demandeMentorat = DemandeMentorat::create([
            'mentor_id' => $validatedData['mentor_id'],
            'mentee_id' => Auth::id(),
            'statut' => 'En attente',
        ]);

        $mentor = Mentor::find($validatedData['mentor_id']);
        $notification = new Notification([
            'objet' => 'Nouvelle demande de mentorat',
            'contenu' => 'Vous avez reçu une nouvelle demande de mentorat de la part de ' . Auth::user()->name,
            'demande_mentorat_id' => $demandeMentorat->id,
        ]);
        $mentor->notifications()->save($notification);

        return response()->json([
            'message' => 'Demande de mentorat envoyée avec succès et notification créée.',
            'demandeMentorat' => $demandeMentorat,
        ], 201);
    }
}

