@extends('admin.layout')

@section('title', $experience->exists ? 'Edit Experience' : 'Tambah Experience')

@section('content')
    <form method="POST" action="{{ $experience->exists ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" enctype="multipart/form-data" class="mx-auto max-w-2xl space-y-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($experience->exists)
            @method('PUT')
        @endif

        @include('admin.partials.field', ['name' => 'title', 'label' => 'Judul', 'value' => old('title', $experience->title), 'required' => true])
        @include('admin.partials.field', ['name' => 'subtitle', 'label' => 'Peran', 'value' => old('subtitle', $experience->subtitle)])
        @include('admin.partials.textarea', ['name' => 'description', 'label' => 'Deskripsi lengkap', 'rows' => 4, 'value' => old('description', $experience->description), 'hint' => 'Tampil di balik kartu saat di-hover.'])
        @include('admin.partials.field', ['name' => 'year', 'label' => 'Tahun', 'value' => old('year', $experience->year), 'required' => true])
        @include('admin.partials.field', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => old('sort_order', $experience->sort_order)])

        <div>
            <label for="image" class="mb-2 block text-sm font-semibold">Gambar</label>
            @if ($experience->imageUrl())
                <img src="{{ $experience->imageUrl() }}" alt="" class="mb-3 h-28 w-44 rounded-2xl object-cover">
            @endif
            <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm">
            @error('image')
                <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
            @enderror
        </div>

        @include('admin.partials.visibility', ['item' => $experience])

        <div class="flex gap-3">
            <button class="rounded-2xl bg-black px-6 py-3 font-semibold text-white transition hover:bg-[#c4526a]">Simpan</button>
            <a href="{{ route('admin.experiences.index') }}" class="rounded-2xl border border-black px-6 py-3 font-semibold">Batal</a>
        </div>
    </form>
@endsection
