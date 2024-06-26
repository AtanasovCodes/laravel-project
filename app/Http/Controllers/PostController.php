<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function viewSinglePost(Post $post)
    {
        $post->body = strip_tags(Str::markdown($post->body), '<p><ul><li><strong><em><h1><h2><h3><h4><h5><h6><a><img><blockquote><code><pre><span><div><br><hr>');
        return view('single-post', ['post' => $post]);
    }
    public function storeNewPost(Request $request)
    {
        $incomingFileds = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
        $incomingFileds['title'] = strip_tags($incomingFileds['title']);
        $incomingFileds['body'] = strip_tags($incomingFileds['body']);
        $incomingFileds['user_id'] = auth()->id();

        Post::create($incomingFileds);
        return redirect('/posts/' . Post::latest()->first()->id);
    }
    public function showCreateForm()
    {
        return view('create-post');
    }
}
