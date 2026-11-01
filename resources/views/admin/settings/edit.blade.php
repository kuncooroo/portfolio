@extends('admin.layout')

@section('title', 'Profil')

@section('content')
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="mx-auto max-w-3xl space-y-6 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-5 md:grid-cols-2">
            @include('admin.partials.field', ['name' => 'page_title', 'label' => 'Judul halaman', 'value' => old('page_title', $setting->page_title), 'required' => true])
            @include('admin.partials.field', ['name' => 'brand_name', 'label' => 'Nama brand', 'value' => old('brand_name', $setting->brand_name), 'required' => true])
            @include('admin.partials.field', ['name' => 'owner_name', 'label' => 'Nama lengkap', 'value' => old('owner_name', $setting->owner_name), 'required' => true])
            @include('admin.partials.field', ['name' => 'greeting', 'label' => 'Sapaan', 'value' => old('greeting', $setting->greeting)])
            @include('admin.partials.field', ['name' => 'roles', 'label' => 'Peran', 'value' => old('roles', $setting->roles), 'placeholder' => 'FULL STACK DEVELOPER • IOT ENGINEER'])
            @include('admin.partials.field', ['name' => 'caption_primary', 'label' => 'Keterangan 1', 'value' => old('caption_primary', $setting->caption_primary)])
            @include('admin.partials.field', ['name' => 'caption_secondary', 'label' => 'Keterangan 2', 'value' => old('caption_secondary', $setting->caption_secondary)])
            @include('admin.partials.field', ['name' => 'footer_note', 'label' => 'Catatan footer', 'value' => old('footer_note', $setting->footer_note)])
        </div>

        @include('admin.partials.textarea', [
            'name' => 'bio',
            'label' => 'Bio',
            'value' => old('bio', $setting->bio),
            'hint' => 'Teks biasa. Tag yang diizinkan: strong, em, br.',
        ])

        <div class="grid gap-5 md:grid-cols-2">
            @include('admin.partials.field', ['name' => 'github', 'label' => 'GitHub', 'type' => 'url', 'value' => old('github', $setting->github)])
            @include('admin.partials.field', ['name' => 'instagram', 'label' => 'Instagram', 'type' => 'url', 'value' => old('instagram', $setting->instagram)])
            @include('admin.partials.field', ['name' => 'linkedin', 'label' => 'LinkedIn', 'type' => 'url', 'value' => old('linkedin', $setting->linkedin)])
            @include('admin.partials.field', ['name' => 'whatsapp', 'label' => 'WhatsApp', 'type' => 'url', 'value' => old('whatsapp', $setting->whatsapp), 'placeholder' => 'https://wa.me/62...'])
            @include('admin.partials.field', ['name' => 'email', 'label' => 'Email publik', 'type' => 'email', 'value' => old('email', $setting->email)])
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="photo" class="mb-2 block text-sm font-semibold">Foto profil</label>
                @if ($setting->photoUrl())
                    <img src="{{ $setting->photoUrl() }}" alt="" class="mb-3 h-28 rounded-2xl object-cover">
                @endif
                <input id="photo" name="photo" type="file" accept="image/*" class="block w-full text-sm">
                @error('photo')
                    <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="cv" class="mb-2 block text-sm font-semibold">CV (PDF)</label>
                @if ($setting->cvUrl())
                    <a href="{{ $setting->cvUrl() }}" target="_blank" class="mb-3 inline-block text-sm font-semibold text-[#c4526a]">Lihat CV saat ini</a>
                @endif
                <input id="cv" name="cv" type="file" accept="application/pdf" class="block w-full text-sm">
                @error('cv')
                    <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button class="rounded-2xl bg-black px-6 py-3 font-semibold text-white transition hover:bg-[#c4526a]">Simpan profil</button>
    </form>
@endsection
