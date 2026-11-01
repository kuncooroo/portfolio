<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Support\UploadedMedia;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::query()->ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.experiences.form', [
            'experience' => new Experience([
                'year' => (string) now()->year,
                'is_visible' => true,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $experience = new Experience;
        $this->save($request, $experience);

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $this->save($request, $experience);

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        UploadedMedia::deleteIfUploaded($experience->image);
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil dihapus.');
    }

    public function move(Request $request, Experience $experience)
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        Experience::moveItem($experience->id, $direction);

        return back();
    }

    private function save(Request $request, Experience $experience): void
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'subtitle' => ['nullable', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:2000'],
            'year' => ['required', 'string', 'max:8'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? ($experience->exists ? $experience->sort_order : Experience::nextSortOrder());

        if ($request->hasFile('image')) {
            UploadedMedia::deleteIfUploaded($experience->image);
            $validated['image'] = UploadedMedia::store($request->file('image'), 'experiences');
        } else {
            unset($validated['image']);
        }

        $experience->fill($validated)->save();
    }
}
