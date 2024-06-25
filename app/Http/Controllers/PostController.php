<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
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
        return 'Post created successfully!';
        // return redirect('/blog');
    }
    public function showCreateForm()
    {
        return view('create-post');
    }
}
