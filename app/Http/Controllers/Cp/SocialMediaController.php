<?php

namespace App\Http\Controllers\Cp;

use App\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cp.social-media.index', [
            'socialMedia' => SocialMedia::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cp.social-media.create');
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
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ]);

        SocialMedia::create([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $request->icon,
        ]);

        return redirect(route('cp.social-media.index'))
                    ->with('success', 'Media Sosial berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedia $socialMedia)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedia $socialMedia)
    {
        return view('cp.social-media.edit', [
            'socialMedia' => $socialMedia
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ]);

        $socialMedia->update([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $request->icon,
        ]);

        return redirect(route('cp.social-media.index'))
                    ->with('success', 'Media Sosial berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();

        return redirect(route('cp.social-media.index'))
                    ->with('success', 'Media Sosial berhasil dihapus.');
    }
}
