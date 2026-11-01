<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\UploadedMedia;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::query()->ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => new Project([
                'year' => (string) now()->year,
                'is_visible' => true,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $project = new Project;
        $this->save($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->save($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        UploadedMedia::deleteIfUploaded($project->image);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    public function move(Request $request, Project $project)
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        Project::moveItem($project->id, $direction);

        return back();
    }

    private function save(Request $request, Project $project): void
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'subtitle' => ['nullable', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:2000'],
            'year' => ['required', 'string', 'max:8'],
            'url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? ($project->exists ? $project->sort_order : Project::nextSortOrder());

        if ($request->hasFile('image')) {
            UploadedMedia::deleteIfUploaded($project->image);
            $validated['image'] = UploadedMedia::store($request->file('image'), 'projects');
        } else {
            unset($validated['image']);
        }

        $project->fill($validated)->save();
    }
}
