<?php

namespace App\Http\Controllers\Admin;
//namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
// use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')
                        ->paginate(5);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
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
        $request->validate($this->makeValid(), $this->makeMessage());

        $data = $request->all();
        // dd($data);

        $new_post = new Post();
        // $new_post->title = $data['title'];
        // $new_post->content = $data['content'];
        $new_post->fill($data);

        $new_post->slug = Post::makeSlug($data['title']);
        $new_post->save();

        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $categories = Category::all();

        $tags = Tag::all();

        if($post){
            return view('admin.posts.show', compact('post', 'categories'));
        }
        abort(404, 'Questa pagina non esiste');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post = Post::find($id);
       $categories = Category::all();
       $tags = Tag::all();

       if($post){
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
       }
       abort(404, "Qeusta pagina non esiste");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate($this->makeValid(), $this->makeMessage() );

        $data = $request->all();

        if($data['title'] != $post->title){
           $data['slug'] =  Post::makeSlug($data['title']);
        };
        
        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    private function makeValid(){
        return [    
            "title"=>"required|max:50|min:2",
            "content"=>"required|max:500|min:2"
        ];
    }

    private function makeMessage(){
        return [    
            "title.required"=>"Il titolo ?? obbligatorio",
            "title.min"=>"Devi inseirire minimo 2 caratteri",
            "title.max"=>"Puoi inseirire massimo 50 caratteri",
            "content.max"=>"Puoi inseirire massimo 500 caratteri",
            "content.min"=>"Devi inseirire minimo 2 caratteri",
            "content.required"=>"Il contenuto ?? un campo ?? obbligatorio",
        ];
    }
}

