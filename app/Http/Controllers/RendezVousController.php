<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezVous = RendezVous::all();
        return response()->json($rendezVous);
    }

    public function create()
    {
        // Not necessary for API
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sujet' => 'required|string|max:255',
            'date_rendezVous' => 'required|date',
            'statut' => 'required|in:Reporté,Confirmé',
            'mente_id' => 'required|exists:mentes,id',
            'mentor_id' => 'required|exists:mentors,id',
        ]);

        $rendezVous = RendezVous::create($validatedData);

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

    public function update(Request $request, $id)
    {
        $rendezVous = RendezVous::findOrFail($id);

        $validatedData = $request->validate([
            'sujet' => 'sometimes|string|max:255',
            'date_rendezVous' => 'sometimes|date',
            'statut' => 'sometimes|in:Reporté,Confirmé',
            'mente_id' => 'sometimes|exists:mentes,id',
            'mentor_id' => 'sometimes|exists:mentors,id',
        ]);

        $rendezVous->update($validatedData);

        return response()->json($rendezVous);
    }

    public function destroy($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->delete();

        return response()->json(null, 204);
    }
}
