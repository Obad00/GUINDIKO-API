<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRendezVousRequest;
use App\Http\Requests\UpdateRendezVousRequest;
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

    public function store(StoreRendezVousRequest $request)
    {

        $rendezVous = RendezVous::create($request->all());

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
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->update($request->all());

        return response()->json($rendezVous);
    }

    public function destroy($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->delete();

        return response()->json(null, 204);
    }
}
