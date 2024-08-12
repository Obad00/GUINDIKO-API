<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentaireForumRequest;
use App\Http\Requests\UpdateCommentaireForumRequest;
use App\Models\CommentaireForum;
use Illuminate\Http\Request;

class CommentaireForumController extends Controller
{
    // Create a new comment
    public function store(StoreCommentaireForumRequest $request)
    {


        $commentaire = CommentaireForum::create($request->all());

        return response()->json($commentaire, 201);
    }

    // Get all comments
    public function index()
    {
        $commentaires = CommentaireForum::all();
        return response()->json($commentaires);
    }

    // Get a specific comment
    public function show($id)
    {
        $commentaire = CommentaireForum::findOrFail($id);
        return response()->json($commentaire);
    }

    // Update a comment
    public function update(UpdateCommentaireForumRequest $request, $id)
    {
        $commentaire = CommentaireForum::findOrFail($id);


        $commentaire->update($request->all());

        return response()->json($commentaire);
    }

    // Delete a comment
    public function destroy($id)
    {
        $commentaire = CommentaireForum::findOrFail($id);
        $commentaire->delete();

        return response()->json(null, 204);
    }
}
