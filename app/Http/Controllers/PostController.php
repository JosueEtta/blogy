<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('home', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $request->user()->posts()->create($validated);

        if ($post) {
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Post created successfully!',
            ]);
        }

        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'Unable to create post. Please try again.',
        ]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $updated = $post->update($validated);

        if ($updated) {
            return redirect()->route('home')->with('toast', [
                'type' => 'success',
                'message' => 'Post updated successfully!',
            ]);
        }

        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'Could not update the post.',
        ]);
    }

    public function destroy(Post $post)
    {
        $deleted = $post->delete();

        if ($deleted) {
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Post deleted successfully!',
            ]);
        }

        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'Failed to delete post.',
        ]);
    }
}
