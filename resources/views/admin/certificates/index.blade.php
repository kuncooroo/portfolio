@extends('admin.layout')

@section('title', 'Certificates')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-gray-600">Sertifikat yang disembunyikan tidak muncul di halaman utama.</p>
        <a href="{{ route('admin.certificates.create') }}" class="rounded-2xl bg-[#c4526a] px-5 py-3 text-sm font-semibold text-white">Tambah</a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-gray-100 text-xs uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-4 py-4">Sertifikat</th>
                    <th class="px-4 py-4">Tahun</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($certificates as $certificate)
                    <tr class="border-b border-gray-50">
                        <td class="px-4 py-4">
                            <p class="font-semibold">{{ $certificate->title }}</p>
                            <p class="text-xs text-gray-500">{{ $certificate->issuer }}</p>
                        </td>
                        <td class="px-4 py-4">{{ $certificate->year }}</td>
                        <td class="px-4 py-4">{{ $certificate->is_visible ? 'Tayang' : 'Disembunyikan' }}</td>
                        <td class="px-4 py-4">@include('admin.partials.row-actions', ['route' => 'admin.certificates', 'model' => $certificate])</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-500">Belum ada sertifikat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
