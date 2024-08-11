<?php

namespace App\Http\Controllers;

use App\Models\DemandeMentorat;
use App\Http\Requests\StoreDemandeMentoratRequest;
use App\Http\Requests\UpdateDemandeMentoratRequest;

class DemandeMentoratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demandes = DemandeMentorat::all();
        return $this->customJsonResponse("Voici la liste de vos demandes de mentorat", $demandes);

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
    public function store(StoreDemandeMentoratRequest $request)
    {
        $demande = DemandeMentorat::create($request->validated());
        return $this->customJsonResponse("Demande de mentorat créée avec succès", $demande, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandeMentorat $demandeMentorat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeMentorat $demandeMentorat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeMentoratRequest $request, DemandeMentorat $demandeMentorat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeMentorat $demandeMentorat)
    {
        //
    }
}
