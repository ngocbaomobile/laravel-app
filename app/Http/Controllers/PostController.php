<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        // Eager load comments
        $posts = Post::with('comments')->get();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = Post::create($request->only(['title', 'content']));

        return response()->json($post, 201);
    }
}
