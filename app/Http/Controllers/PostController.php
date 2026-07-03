<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(6);

        return view('news.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('post', 'relatedPosts'));
    }
}
