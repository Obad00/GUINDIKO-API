<?php

namespace App\Http\Controllers;

use App\Models\PostForum;
use Illuminate\Http\Request;

class PostForumController extends Controller
{
    // Lister les posts
    public function index()
    {
        $posts = PostForum::all();
        return response()->json($posts, 200);
    }

    // Créer un nouveau post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenu' => 'required|string',
            'image' => 'nullable|string',
            'forum_id' => 'required|exists:forums,id',
        ]);

        $post = PostForum::create($validated);

        return response()->json($post, 201);
    }

    // Afficher un post spécifique
    public function show($id)
    {
        $post = PostForum::find($id);

        if (!$post) {
            return response()->json(['message' => 'Poste non trouvé'], 404);
        }

        return response()->json($post, 200);
    }

    // Mettre à jour un post existant
    public function update(Request $request, $id)
    {
        $post = PostForum::find($id);

        if (!$post) {
            return response()->json(['message' => 'Poste non trouvé'], 404);
        }

        $validated = $request->validate([
            'contenu' => 'required|string',
            'image' => 'nullable|string',
            'forum_id' => 'required|exists:forums,id',
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    // Supprimer un post
    public function destroy($id)
    {
        $post = PostForum::find($id);

        if (!$post) {
            return response()->json(['message' => 'Poste non trouvé'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post supprimé avec succès'], 200);
    }
}

