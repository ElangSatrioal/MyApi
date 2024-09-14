<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data', $posts]);

        // Untuk mengambil data banyak atau array
        return response()->json($posts);

        return view('index', [
            'title' => 'User View',
            'posts' => PostResource::collection($posts)
        ]);
    }

    public function show($id)
    {
        $post = Post::with('writer:id,firstname')->findOrFail($id);
        // return response()->json(['data' => $post]);

        // Untuk non array alias cuma 1 objek
        return new PostDetailResource($post);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required'
        ]);

        $request['author'] = 1;

        $post = Post::create($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,firstname'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required'
        ]);

        $post = Post::findOrFail($id);

        if ($post->author != 1) {
            return response()->json(['message' => 'Data not Found'], 404);
        }

        $post->update($validated);

        return new PostDetailResource($post->loadMissing('writer:id,firstname'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return new PostDetailResource($post->loadMissing('writer:id,firstname'));
    }
}
