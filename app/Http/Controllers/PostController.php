<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Subject;

class PostController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $posts = Post::all();
        return view('posts/index', ['posts' => $posts, 'keyword' => $keyword]);
    }
    
    public function search(Request $request, Post $post)
    {
        $keyword = $request->input('keyword');
       
        if ($keyword) {
            $search = Post::where('title', 'like', '%'.$keyword.'%')->get();
            return view('posts.search');
        }
        else{
            return view('posts.no_results');
        }
    }
    
    public function show(Post $post)
    {
        //dd($post);
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function create(Subject $subject, Category $categories)
    {
        return view('posts.create')->with(['subjects' => $subject->get(), 'categories' => $categories->get()]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
?>