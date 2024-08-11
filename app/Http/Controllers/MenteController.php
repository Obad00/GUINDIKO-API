<?php

namespace App\Http\Controllers;

use App\Models\Mente;
use App\Http\Requests\StoreMenteRequest;
use App\Http\Requests\UpdateMenteRequest;

class MenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentes = Mente::all();
        return $this-> customJsonResponse("Voici la liste de vos Mentees", $mentes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenteRequest $request)
 {
    //     $mente = Mente::create($request->all());
    //     return $this->customJsonResponse("Mentee créé avec succès", $mente);

    $mente = new Mente();
    $mente->fill($request->validated());
    $mente->save();
    return $this->customJsonResponse("mente créé avec succès", $mente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mente $mente)
    {
        return $this->customJsonResponse("Mentee récupéré avec succès", $mente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mente $mente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenteRequest $request, Mente $mente)
    {
        $mente->fill($request->validated());
        $mente->update();
        return response()->json(['message' => 'mente modifié avec succès', 'mente' => $mente], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mente $mente)
    {
        $mente->delete();
        return $this->customJsonResponse("Mentee supprimé avec succès", 200);
    }
}
