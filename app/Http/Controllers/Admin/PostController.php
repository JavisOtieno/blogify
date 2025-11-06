<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'status'=>'required|in:draft,published'
        ]);
        Post::create($data + ['source'=>'manual','external_id'=>0]);
        return redirect()->route('admin.posts.index')->with('success','Post created');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $r, Post $post)
    {
        $data = $r->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'status'=>'required|in:draft,published'
        ]);
        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success','Post updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','Post deleted');
    }

    // endpoint to trigger import from UI
    public function import(Request $r)
    {
        $r->validate(['source'=>'required|string']);
        $source = $r->post('source');
        \Artisan::call('import:random', ['source' => $source]);
        $output = \Artisan::output();
        return redirect()->route('admin.posts.index')->with('success', trim($output));
    }
}
