@extends('admin.layout')

@section('title', 'Experience')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-gray-600">Urutan menentukan posisi kartu di halaman utama.</p>
        <a href="{{ route('admin.experiences.create') }}" class="rounded-2xl bg-[#c4526a] px-5 py-3 text-sm font-semibold text-white">Tambah</a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-gray-100 text-xs uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-4 py-4">Pengalaman</th>
                    <th class="px-4 py-4">Tahun</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($experiences as $experience)
                    <tr class="border-b border-gray-50">
                        <td class="px-4 py-4">
                            <p class="font-semibold">{{ $experience->title }}</p>
                            <p class="text-xs text-gray-500">{{ $experience->subtitle }}</p>
                        </td>
                        <td class="px-4 py-4">{{ $experience->year }}</td>
                        <td class="px-4 py-4">{{ $experience->is_visible ? 'Tayang' : 'Disembunyikan' }}</td>
                        <td class="px-4 py-4">@include('admin.partials.row-actions', ['route' => 'admin.experiences', 'model' => $experience])</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-500">Belum ada pengalaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
