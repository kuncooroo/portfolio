@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <p class="handwriting text-4xl text-[#c4526a]">Halo, {{ $setting->owner_name }}</p>
        <p class="mt-2 max-w-2xl text-gray-600">Ubah isi website dari sini. Perubahan langsung tampil di halaman portofolio.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Skills', $counts['skills'], 'admin.skills.index'],
            ['Experience', $counts['experiences'], 'admin.experiences.index'],
            ['Projects', $counts['projects'], 'admin.projects.index'],
            ['Certificates', $counts['certificates'], 'admin.certificates.index'],
        ] as [$label, $count, $route])
            <a href="{{ route($route) }}" class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-[#c4526a]">
                <p class="text-sm font-medium uppercase tracking-[0.16em] text-gray-400">{{ $label }}</p>
                <p class="mt-3 text-4xl font-black">{{ $count }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-8 grid gap-4 lg:grid-cols-2">
        <a href="{{ route('admin.profile.edit') }}" class="rounded-3xl bg-black p-6 text-white transition hover:bg-[#c4526a]">
            <p class="text-sm uppercase tracking-[0.16em] text-white/70">Profil</p>
            <p class="mt-2 text-2xl font-bold">Edit biodata, foto, CV, dan tautan sosial</p>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="rounded-3xl border border-gray-200 bg-white p-6 transition hover:border-[#c4526a]">
            <p class="text-sm uppercase tracking-[0.16em] text-gray-400">Situs</p>
            <p class="mt-2 text-2xl font-bold">Buka halaman portofolio</p>
        </a>
    </div>
@endsection
