<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $category = Category::where('slug', $request->query('category'))->first();

        $posts = Post::query()
            ->when($request->query('author'), fn ($q, $a) => $q
                ->where('user_id', $a))
            ->when($category, fn ($q, $c) => $q
                ->where('category_id', $c->id))
            ->when($request->query('search'), fn ($q, $s) => $q
                ->where('title', 'like', '%'.$s.'%')
                ->orWhere('body', 'like', '%'.$s.'%'))
            ->paginate(6);

        return view('posts/index', compact('categories', 'category', 'posts'));
    }

    public function show(Post $post)
    {
        return view('posts/show', compact('post'));
    }
}
