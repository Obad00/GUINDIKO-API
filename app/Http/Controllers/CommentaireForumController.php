<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentaireForumRequest;
use App\Http\Requests\UpdateCommentaireForumRequest;
use App\Models\CommentaireForum;
use App\Models\User;
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
        // $commentaires = CommentaireForum::all();
        // return response()->json($commentaires);
        $commentaires = CommentaireForum::with('utilisateur')->get();
        return response()->json($commentaires, 200);
    }

    // Get a specific comment
    public function show($postForumId)
    {
        // $commentaire = CommentaireForum::findOrFail($id);
        // return response()->json($commentaire);
//         $commentaires = CommentaireForum::where('post_forum_id', $postForumId)
//         ->with('user:id,nom,prenom') // Inclure les champs nom et prenom de l'utilisateur
//         ->get();

// return response()->json($commentaires);
  // Récupérer le post par ID
  $commentaire = CommentaireForum::find($postForumId);

  if (!$commentaire) {
      return response()->json(['message' => 'Commentaire non trouvé'], 404);
  }

  // Récupérer les informations de l'utilisateur à partir de user_id
  $user = User::find($commentaire->user_id);

  if (!$user) {
      return response()->json(['message' => 'Utilisateur non trouvé'], 404);
  }

  // Préparer la réponse avec les informations du post et de l'utilisateur
  $response = [
      'commentaire' => $commentaire,
      'user' => $user
  ];

  return response()->json($response, 200);
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
