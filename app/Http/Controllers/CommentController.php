<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create($request->only(['post_id', 'content']));

        return response()->json($comment, 201);
    }
}
