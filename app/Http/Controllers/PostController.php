<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $canSeeDrafts = $user->isAdmin() || $user->isEditor();

        $posts = Post::with('author')
            ->when(! $canSeeDrafts, fn ($q) => $q->published())
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('posts.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Post::class);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        $request->user()->posts()->create($data);

        return redirect()->route('posts.index')->with('status', 'Post berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        $post->update($data);

        return redirect()->route('posts.index')->with('status', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('status', 'Post berhasil dihapus.');
    }
}