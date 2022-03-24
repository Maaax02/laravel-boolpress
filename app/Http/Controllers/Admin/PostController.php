<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $data = $request->validate([
            'title' => 'required|min:2',
            'description' => 'required|min:8',
            'user_id' => 'nullable',
            'category_id' => 'nullable',
            'tags' => 'nullable',
            'coverImg' => 'nullable|image|max:600'
        ]);

        $post = new Post();
        $post->fill($data);
        $post->user_id=Auth::User()->id;
        $post->save();
        if (Key_exists('tags', $data)) {
            $post->tags()->attach($data['tags']);
        }
        
          // se la chiave esiste l'utente sta cercando di uploadare un file
    if (key_exists("coverImg", $data)) {
        $post->coverImg = Storage::put("postCovers", $data["coverImg"]);
      }
  
      $post->save();
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', [
            'tags' => $tags,
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = $request->validate([
        //     'title' => 'required|min:2',
        //     'description' => 'required|min:8',
        //     'user_id' => 'nullable',
        //     'category_id' => 'nullable',
        //     'tags' => 'nullable|exists:tags,id',
        //      "coverImg" => "nullable|image|max:500"
        // ]);
        $data = $request->all();
        $post = Post::findOrFail($id);
        $post->update($data);
        if(key_exists("tags", $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }
        $post->update($data);

        if (key_exists("coverImg", $data)) {
          if ($post->coverImg) {
            Storage::delete($post->coverImg);
          }
    
          $coverImg = Storage::put("postCovers", $data["coverImg"]);
    
          $post->coverImg = $coverImg;
          $post->save();
        }
        return redirect()->route('admin.posts.show', ['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        if ($post->coverImg) {
            Storage::delete($post->coverImg);
        }
        $post->delete();
        return redirect()->route("admin.posts.index");
        
    }
}
