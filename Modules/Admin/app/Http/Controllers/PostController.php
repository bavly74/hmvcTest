<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Admin\Models\Post ;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author')->get() ;
        return view('admin::posts.index',['posts'=>$posts]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        Post::create([
            'title'=>$request->title ,
            'body'=>$request->body ,
            'created_by'=>auth()->user()->id
        ]);
        return redirect()->back()->with('success','post created successfully') ;
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        // $post=Post::findOrFail($id) ;
        // Gate::authorize('view',$post) ;
        // return view('admin::posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id) ;
        Gate::authorize('edit',$post) ;
        return view('admin::posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $post=Post::findOrFail($id) ;
        Gate::authorize('edit',$post) ;
        $post->update([
            'title'=>$request->title ,
            'body'=>$request->body
        ]);
        return redirect()->back()->with('success','post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id) {
        $post = Post::findOrFail($id) ;
        Gate::authorize('destroy',$post) ;
        $post->delete() ;
        return redirect()->back()->with('success','post deleted successfully');

    }
}
