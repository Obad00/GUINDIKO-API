<?php

namespace App\Http\Controllers;

use App\Models\CommentaireForum;
use Illuminate\Http\Request;

class CommentaireForumController extends Controller
{
    // Create a new comment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contenu' => 'required|string',
            'post_forum_id' => 'required|exists:post_forums,id',
        ]);

        $commentaire = CommentaireForum::create($validatedData);

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
    public function update(Request $request, $id)
    {
        $commentaire = CommentaireForum::findOrFail($id);

        $validatedData = $request->validate([
            'contenu' => 'required|string',
        ]);

        $commentaire->update($validatedData);

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
