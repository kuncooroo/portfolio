<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\UploadedMedia;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', [
            'setting' => Setting::current(),
        ]);
    }

    public function update(Request $request)
    {
        $setting = Setting::current();

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:160'],
            'brand_name' => ['required', 'string', 'max:80'],
            'owner_name' => ['required', 'string', 'max:120'],
            'greeting' => ['nullable', 'string', 'max:120'],
            'roles' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'caption_primary' => ['nullable', 'string', 'max:160'],
            'caption_secondary' => ['nullable', 'string', 'max:160'],
            'github' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'whatsapp' => ['nullable', 'url', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'footer_note' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        unset($validated['photo'], $validated['cv']);

        if ($request->hasFile('photo')) {
            UploadedMedia::deleteIfUploaded($setting->photo);
            $validated['photo'] = UploadedMedia::store($request->file('photo'), 'profile');
        }

        if ($request->hasFile('cv')) {
            UploadedMedia::deleteIfUploaded($setting->cv_path);
            $validated['cv_path'] = UploadedMedia::store($request->file('cv'), 'cv');
        }

        $setting->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil website berhasil disimpan.');
    }
}
