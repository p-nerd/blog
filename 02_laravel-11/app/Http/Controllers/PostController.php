<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->get();

        $query = Post::query();

        $author = $request->query('author');
        if ($author) {
            $query = $query->where('user_id', $author);
        }

        $category = Category::where('slug', $request->query('category'))->first();
        if ($category) {
            $query = $query->where('category_id', $category->id);
        }

        $search = $request->query('search');
        if ($search) {
            $query = $query->where('title', 'like', '%'.$search.'%');
            $query = $query->orWhere('body', 'like', '%'.$search.'%');
        }

        $posts = $query->paginate(6);

        return view('posts/index', [
            'posts' => $posts,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function show(Post $post)
    {
        return view('posts/show', [
            'post' => $post,
        ]);
    }
}
