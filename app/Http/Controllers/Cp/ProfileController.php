<?php

namespace App\Http\Controllers\Cp;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('cp.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'setting.about_image' => 'image'
        ],[
            'setting.about_image.image' => 'Cover About Me must be an image.'
        ]);

        collect($request->setting)
            ->each(function($value, $key) use($request){
                if ($key == 'about_image') {
                    if ($request->hasFile('setting.about_image')) {
                        $file = $request->file('setting.about_image');
                        $value = $file->move('files/', generateFileName('contact-page', $file));
                    }
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
        });

        return redirect(route('cp.settings.edit'))
                    ->with('success', 'Setting saved.');
    }
}
