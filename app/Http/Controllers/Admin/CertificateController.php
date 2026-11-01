<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Support\UploadedMedia;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return view('admin.certificates.index', [
            'certificates' => Certificate::query()->ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.certificates.form', [
            'certificate' => new Certificate([
                'year' => (string) now()->year,
                'is_visible' => true,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $certificate = new Certificate;
        $this->save($request, $certificate);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.form', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $this->save($request, $certificate);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate)
    {
        UploadedMedia::deleteIfUploaded($certificate->image);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus.');
    }

    public function move(Request $request, Certificate $certificate)
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        Certificate::moveItem($certificate->id, $direction);

        return back();
    }

    private function save(Request $request, Certificate $certificate): void
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'issuer' => ['nullable', 'string', 'max:120'],
            'year' => ['nullable', 'string', 'max:8'],
            'description' => ['nullable', 'string', 'max:2000'],
            'credential_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? ($certificate->exists ? $certificate->sort_order : Certificate::nextSortOrder());

        if ($request->hasFile('image')) {
            UploadedMedia::deleteIfUploaded($certificate->image);
            $validated['image'] = UploadedMedia::store($request->file('image'), 'certificates');
        } else {
            unset($validated['image']);
        }

        $certificate->fill($validated)->save();
    }
}
