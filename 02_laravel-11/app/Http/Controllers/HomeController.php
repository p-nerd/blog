<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->get();

        $category = Category::query()
            ->where('slug', $request->query('category'))
            ->first();

        $posts = Post::query()
            ->when($request->query('author'), fn ($q, $a) => $q
                ->where('user_id', $a))
            ->when($category, fn ($q, $c) => $q
                ->where('category_id', $c->id))
            ->when($request->query('search'), fn ($q, $s) => $q
                ->where('title', 'like', '%'.$s.'%')
                ->orWhere('body', 'like', '%'.$s.'%'))
            ->paginate(6);

        return view('posts/index', [
            'posts' => $posts,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function show(Post $post)
    {
        $comments = $post
            ->comments()
            ->latest()
            ->get();

        return view('posts/show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function commentsStore(Request $request, Post $post)
    {
        $payload = $request->validate([
            'body' => ['required', 'string'],
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $payload['body'],
        ]);

        return redirect()->back();
    }
}
