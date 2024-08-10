<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Http\Requests\StoreForumRequest;
use App\Http\Requests\UpdateForumRequest;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Récupération de tous les forums
    $forums = Forum::all();

    // Retourne la réponse JSON avec la liste des forums
    return response()->json($forums);
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
    public function store(StoreForumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
{
    // Retourne la réponse JSON avec les détails du forum
    return response()->json($forum);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumRequest $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        //
    }
}
