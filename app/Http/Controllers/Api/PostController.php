<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        // return response()->json([
        //     'esito' => 'ok',
        //     'date' => now(),
        //     'data' => $posts
        // ]);
        $posts->load('user', 'category');
        $posts->each(function($post){
            if($post->coverImg){
                $post->coverImg = asset('storage/' . $post->coverImg);
            }
        });
        return response()->json($posts);
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required|min:2',
            'description' => 'required|min:8',
            'user_id' => 'nullable',
            'category_id' => 'nullable',
            'tags' => 'nullable',
            'coverImg' => 'nullable|image|max:700'
        ]);
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->user_id = 6;
        $newPost->save();
        return response()->json($newPost);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $post->load('user');
        return response()->json($post);
    }
}
