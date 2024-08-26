<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostForumRequest;
use App\Http\Requests\UpdatePostForumRequest;
use App\Models\PostForum;
use Illuminate\Http\Request;

class PostForumController extends Controller
{
    public function index()
    {
        $posts = PostForum::with('user')->get();
        return response()->json($posts, 200);
    }

    // Créer un nouveau post
    public function store(StorePostForumRequest $request)
    {
        // $validated = $request->validate([

        // ]);

        $post = PostForum::create($request->all());

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = PostForum::with('user')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Poste non trouvé'], 404);
        }

        return response()->json($post, 200);
    }


    // Mettre à jour un post existant
    public function update(UpdatePostForumRequest $request, $id)
    {
        $post = PostForum::find($id);

        if (!$post) {
            return response()->json(['message' => 'Poste non trouvé'], 404);
        }

        // $validated = $request->validate([

        // ]);

        $post->update($request->all());

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

