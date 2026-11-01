<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Dashboard') — Admin</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Caveat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none !important}</style>
</head>
<body class="bg-[#fafafa] text-[#111]">
    <div x-data="{ open: false }" class="min-h-screen lg:grid lg:grid-cols-[260px_1fr]">
        <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-30 bg-black/40 lg:hidden" @click="open = false"></div>

        <aside class="fixed inset-y-0 left-0 z-40 flex w-[260px] -translate-x-full flex-col border-r border-gray-200 bg-white transition lg:static lg:translate-x-0"
            :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <div class="border-b border-gray-100 px-6 py-6">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black tracking-tight">
                    {{ $setting->brand_name ?? 'Admin' }}<span class="text-[#c4526a]">.</span>
                </a>
                <p class="mt-1 text-xs uppercase tracking-[0.2em] text-gray-400">Dashboard</p>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-4">
                @foreach ([
                    ['admin.dashboard', 'Dashboard', 'fa-solid fa-gauge', false],
                    ['admin.profile.edit', 'Profil', 'fa-regular fa-user', false],
                    ['admin.skills.*', 'Skills', 'fa-solid fa-code', true],
                    ['admin.experiences.*', 'Experience', 'fa-solid fa-briefcase', true],
                    ['admin.projects.*', 'Projects', 'fa-regular fa-folder-open', true],
                    ['admin.certificates.*', 'Certificates', 'fa-solid fa-certificate', true],
                    ['admin.password.edit', 'Password', 'fa-solid fa-key', false],
                ] as [$route, $label, $icon, $wildcard])
                    <a href="{{ $wildcard ? route(str_replace('.*', '.index', $route)) : route($route) }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium {{ request()->routeIs($route) ? 'bg-[#c4526a] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="{{ $icon }} w-4 text-center"></i>
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="space-y-3 border-t border-gray-100 px-4 py-4">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-600 hover:bg-gray-100">
                    <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center"></i>
                    Lihat situs
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm font-medium text-gray-600 hover:bg-gray-100">
                        <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                        Keluar
                    </button>
                </form>
                <p class="px-3 text-xs text-gray-400">{{ auth()->user()->email }}</p>
            </div>
        </aside>

        <div class="min-w-0">
            <header class="sticky top-0 z-20 flex items-center justify-between border-b border-gray-200 bg-white/80 px-4 py-4 backdrop-blur lg:px-8">
                <button class="rounded-xl border border-gray-200 px-3 py-2 lg:hidden" @click="open = true" aria-label="Buka menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="font-semibold">@yield('title', 'Dashboard')</h1>
                <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
            </header>

            <main class="px-4 py-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
