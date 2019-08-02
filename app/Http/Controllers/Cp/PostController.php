<?php

namespace App\Http\Controllers\Cp;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cp.post.index', [
            'posts' => Post::latest()
                            ->paginate(config('pagination.perPage'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cp.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'cover' => 'image',
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $coverImage = $file->move('files/cover/', generateFileName($request->title, $file));
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => !empty($coverImage) ? $coverImage : null
        ]);

        return redirect(route('cp.posts.index'))
                    ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('cp.post.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('cp.post.edit', [
            'post' => $post
        ]);
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'cover' => 'image',
        ]);

        if ($request->hasFile('cover')) {
            removeFile($post->cover);
            $file = $request->file('cover');
            $coverImage = $file->move('files/cover/', generateFileName($request->title, $file));
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => !empty($coverImage) ? $coverImage : $post->cover
        ]);

        return redirect(route('cp.posts.index'))
                    ->with('success', 'Berita berhasil diupdate.');
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

        return redirect(route('cp.posts.index'))
                    ->with('success', 'Berita berhasil dihapus.');
    }
}
