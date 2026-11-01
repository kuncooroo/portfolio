<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Support\UploadedMedia;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.skills.index', [
            'skills' => Skill::query()->ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.skills.form', [
            'skill' => new Skill([
                'category' => 'klinik',
                'is_visible' => true,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $skill = new Skill;
        $this->save($request, $skill);

        return redirect()->route('admin.skills.index')->with('success', 'Skill berhasil ditambahkan.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $this->save($request, $skill);

        return redirect()->route('admin.skills.index')->with('success', 'Skill berhasil diperbarui.');
    }

    public function destroy(Skill $skill)
    {
        UploadedMedia::deleteIfUploaded($skill->icon);
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill berhasil dihapus.');
    }

    public function move(Request $request, Skill $skill)
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        Skill::moveItem($skill->id, $direction);

        return back();
    }

    private function save(Request $request, Skill $skill): void
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'category' => ['required', 'string', 'max:40'],
            'icon' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? ($skill->exists ? $skill->sort_order : Skill::nextSortOrder());
        $validated['category'] = strtolower(trim($validated['category']));

        if ($request->hasFile('image')) {
            UploadedMedia::deleteIfUploaded($skill->icon);
            $validated['icon'] = UploadedMedia::store($request->file('image'), 'skills');
        } elseif ($validated['icon'] === null || $validated['icon'] === '') {
            $validated['icon'] = $skill->icon;
        } elseif ($skill->icon && $validated['icon'] !== $skill->icon) {
            UploadedMedia::deleteIfUploaded($skill->icon);
        }

        unset($validated['image']);

        $skill->fill($validated)->save();
    }
}
