@extends('admin.layout')

@section('title', 'Password')

@section('content')
    <form method="POST" action="{{ route('admin.password.update') }}" class="mx-auto max-w-lg space-y-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.partials.field', ['name' => 'current_password', 'label' => 'Password saat ini', 'type' => 'password', 'required' => true, 'value' => ''])
        @include('admin.partials.field', ['name' => 'password', 'label' => 'Password baru', 'type' => 'password', 'required' => true, 'value' => ''])
        @include('admin.partials.field', ['name' => 'password_confirmation', 'label' => 'Ulangi password baru', 'type' => 'password', 'required' => true, 'value' => ''])
        <button class="rounded-2xl bg-black px-6 py-3 font-semibold text-white transition hover:bg-[#c4526a]">Ganti password</button>
    </form>
@endsection
