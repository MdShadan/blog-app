<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;


class PostController extends Controller
{
     public function __construct() {

        $this->middleware('auth', ['only' => ['create', 'edit', 'store', 'delete']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(2);

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        $tags = Tag::all();
        return view('posts.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
       
      $store =  Post::create([
                  'user_id'     =>  \Auth::id(),
                  'title'       =>  $request->title,
                  'description' =>  $request->description,
                   'slug'       =>  \Str::slug($request->title),
                ]);

        for($i = 0; $i < count($request->tags); $i++)
        {
            $storeTag = Tag::firstOrCreate(['title' => $request->tags[$i]]);
            $store->tags()->attach( $storeTag );
        }

        return redirect('posts')->with('success', 'Post created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::with('tags')->where('slug',$slug)->first();
        if(!$post) return redirect('posts')->with('error', 'Post not found');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $tags = Tag::all();
       $post = Post::with('tags')->where('id', $id)->first();
       return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        
       if($post->user_id != \Auth::id()) return redirect()->back()->with('error', 'You are not able to edit this post');

        $post->update([
                             
                     'title'       =>  $request->title,
                     'description' =>  $request->description,
                     'slug'       =>  \Str::slug($request->title),
                ]);

        $post->tags()->detach();

        for($i = 0; $i < count($request->tags); $i++)
        {
            $storeTag = Tag::firstOrCreate(['title' => $request->tags[$i]]);
            $post->first()->tags()->attach( $storeTag );
        }

        return redirect()->back()->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
         if($post->user_id != \Auth::id()) return redirect()->back()->with('error', 'You are not able to delete this post');

         $post->delete();

         return redirect('posts')->with('success', 'Post deleted successfully!');
    
    }
}
