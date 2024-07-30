<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

/*use App\Models\Post;*/
/*use Illuminate\Http\Request;*/

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        }

        $posts = $query->paginate(6);

        return view('posts/index', [
            'posts' => $posts,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    /*public function create()*/
    /*{*/
    /*    //*/
    /*}*/

    /**
     * Store a newly created resource in storage.
     */
    /*public function store(Request $request)*/
    /*{*/
    /*    //*/
    /*}*/

    /**
     * Display the specified resource.
     */
    /*public function show(Post $post)*/
    /*{*/
    /*    //*/
    /*}*/

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(Post $post)*/
    /*{*/
    /*    //*/
    /*}*/

    /**
     * Update the specified resource in storage.
     */
    /*public function update(Request $request, Post $post)*/
    /*{*/
    /*    //*/
    /*}*/

    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(Post $post)*/
    /*{*/
    /*    //*/
    /*}*/
}
