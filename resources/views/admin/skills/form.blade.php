@extends('admin.layout')

@section('title', $skill->exists ? 'Edit Skill' : 'Tambah Skill')

@section('content')
    <form method="POST" action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" enctype="multipart/form-data" class="mx-auto max-w-2xl space-y-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($skill->exists)
            @method('PUT')
        @endif

        @include('admin.partials.field', ['name' => 'name', 'label' => 'Nama', 'value' => old('name', $skill->name), 'required' => true])
        @include('admin.partials.field', ['name' => 'category', 'label' => 'Kategori', 'value' => old('category', $skill->category), 'required' => true, 'placeholder' => 'web, ai, iot, mobile, tools, gaming'])
        @include('admin.partials.field', ['name' => 'icon', 'label' => 'Class ikon Devicon', 'value' => old('icon', $skill->usesImage() ? '' : $skill->icon), 'placeholder' => 'devicon-laravel-plain'])
        @include('admin.partials.field', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => old('sort_order', $skill->sort_order)])

        <div>
            <label for="image" class="mb-2 block text-sm font-semibold">Atau unggah gambar ikon</label>
            @if ($skill->usesImage() && $skill->iconUrl())
                <img src="{{ $skill->iconUrl() }}" alt="" class="mb-3 h-16 w-16 rounded-full object-contain">
            @endif
            <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm">
            <p class="mt-2 text-xs text-gray-500">Gambar menggantikan class ikon. Kosongkan class ikon bila ingin mempertahankan gambar yang sudah ada.</p>
            @error('image')
                <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
            @enderror
        </div>

        @include('admin.partials.visibility', ['item' => $skill])

        <div class="flex gap-3">
            <button class="rounded-2xl bg-black px-6 py-3 font-semibold text-white transition hover:bg-[#c4526a]">Simpan</button>
            <a href="{{ route('admin.skills.index') }}" class="rounded-2xl border border-black px-6 py-3 font-semibold">Batal</a>
        </div>
    </form>
@endsection
