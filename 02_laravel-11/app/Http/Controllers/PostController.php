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
        $category = $request->query('category');

        return view('posts/index', [
            'categories' => Category::all(),
            'category' => Category::where('slug', $category)->first(),
            'posts' => Post::query()->paginate(),
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
