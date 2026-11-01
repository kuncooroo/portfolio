@extends('admin.layout')

@section('title', $project->exists ? 'Edit Project' : 'Tambah Project')

@section('content')
    <form method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data" class="mx-auto max-w-2xl space-y-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($project->exists)
            @method('PUT')
        @endif

        @include('admin.partials.field', ['name' => 'title', 'label' => 'Judul', 'value' => old('title', $project->title), 'required' => true])
        @include('admin.partials.field', ['name' => 'subtitle', 'label' => 'Teknologi', 'value' => old('subtitle', $project->subtitle), 'placeholder' => 'Laravel . MySQL'])
        @include('admin.partials.textarea', ['name' => 'description', 'label' => 'Deskripsi lengkap', 'rows' => 4, 'value' => old('description', $project->description), 'hint' => 'Tampil di balik kartu saat di-hover.'])
        @include('admin.partials.field', ['name' => 'year', 'label' => 'Tahun', 'value' => old('year', $project->year), 'required' => true])
        @include('admin.partials.field', ['name' => 'url', 'label' => 'Tautan', 'type' => 'url', 'value' => old('url', $project->url), 'placeholder' => 'https://'])
        @include('admin.partials.field', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => old('sort_order', $project->sort_order)])

        <div>
            <label for="image" class="mb-2 block text-sm font-semibold">Gambar</label>
            @if ($project->imageUrl())
                <img src="{{ $project->imageUrl() }}" alt="" class="mb-3 h-28 w-44 rounded-2xl object-cover">
            @endif
            <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm">
            @error('image')
                <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
            @enderror
        </div>

        @include('admin.partials.visibility', ['item' => $project])

        <div class="flex gap-3">
            <button class="rounded-2xl bg-black px-6 py-3 font-semibold text-white transition hover:bg-[#c4526a]">Simpan</button>
            <a href="{{ route('admin.projects.index') }}" class="rounded-2xl border border-black px-6 py-3 font-semibold">Batal</a>
        </div>
    </form>
@endsection
