<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comments;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('blog', [
            'title' => 'All Posts',
            'data' => Post::latest()->paginate(10)
        ]);
    }

    public function show(Post $post)
    {
        return view('singlepost', [
            'title' => 'Single Post',
            'data' => $post,
            'cmn' => $post->comments()->latest()->get()
        ]);
    }

    public function storeComment(Post $post, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required|min:3'
        ]);

        $post->comments()->create([
            'post_id' => $post->id,
            'name' => $request->name,
            'body' => $request->body
        ]);

        return back()->with('success', 'Comment added successfully');
    }
}
