@extends('admin.layout')

@section('title', 'Skills')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-gray-600">Ikon memakai class Devicon, atau unggah gambar.</p>
        <a href="{{ route('admin.skills.create') }}" class="rounded-2xl bg-[#c4526a] px-5 py-3 text-sm font-semibold text-white">Tambah</a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-gray-100 text-xs uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-4 py-4">Skill</th>
                    <th class="px-4 py-4">Kategori</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($skills as $skill)
                    <tr class="border-b border-gray-50">
                        <td class="px-4 py-4 font-semibold">{{ $skill->name }}</td>
                        <td class="px-4 py-4 uppercase">{{ $skill->category }}</td>
                        <td class="px-4 py-4">{{ $skill->is_visible ? 'Tayang' : 'Disembunyikan' }}</td>
                        <td class="px-4 py-4">@include('admin.partials.row-actions', ['route' => 'admin.skills', 'model' => $skill])</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-500">Belum ada skill.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
