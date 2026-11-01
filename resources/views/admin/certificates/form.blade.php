@extends('admin.layout')

@section('title', $certificate->exists ? 'Edit Certificate' : 'Tambah Certificate')

@section('content')
    <form method="POST" action="{{ $certificate->exists ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}" enctype="multipart/form-data" class="mx-auto max-w-2xl space-y-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($certificate->exists)
            @method('PUT')
        @endif

        @include('admin.partials.field', ['name' => 'title', 'label' => 'Judul', 'value' => old('title', $certificate->title), 'required' => true])
        @include('admin.partials.field', ['name' => 'issuer', 'label' => 'Penerbit', 'value' => old('issuer', $certificate->issuer)])
        @include('admin.partials.field', ['name' => 'year', 'label' => 'Tahun', 'value' => old('year', $certificate->year)])
        @include('admin.partials.field', ['name' => 'credential_url', 'label' => 'Tautan kredensial', 'type' => 'url', 'value' => old('credential_url', $certificate->credential_url)])
        @include('admin.partials.field', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => old('sort_order', $certificate->sort_order)])
        @include('admin.partials.textarea', ['name' => 'description', 'label' => 'Deskripsi', 'rows' => 3, 'value' => old('description', $certificate->description)])

        <div>
            <label for="image" class="mb-2 block text-sm font-semibold">Gambar</label>
            @if ($certificate->imageUrl())
                <img src="{{ $certificate->imageUrl() }}" alt="" class="mb-3 h-28 w-44 rounded-2xl object-cover">
            @endif
            <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm">
            @error('image')
                <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
            @enderror
        </div>

        @include('admin.partials.visibility', ['item' => $certificate])

        <div class="flex gap-3">
            <button class="rounded-2xl bg-black px-6 py-3 font-semibold text-white transition hover:bg-[#c4526a]">Simpan</button>
            <a href="{{ route('admin.certificates.index') }}" class="rounded-2xl border border-black px-6 py-3 font-semibold">Batal</a>
        </div>
    </form>
@endsection
