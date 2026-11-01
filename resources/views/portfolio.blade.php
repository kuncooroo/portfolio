<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->page_title }}</title>
    <meta name="description" content="Portfolio {{ $setting->owner_name }}, mahasiswa Kedokteran Gigi angkatan 2024 di Universitas Jember.">
    <link rel="icon" href="{{ asset('images/portrait.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@500;700;800&family=Caveat:wght@700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/clinic.css', 'resources/js/site.js'])
</head>
<body>
    @include('partials.navbar')
    @include('partials.social')
    <main class="clinic-bg">
        @include('sections.about')
        @include('sections.skills')
        @include('sections.experience')
        @include('sections.projects')
        @include('sections.certificates')
    </main>
    @include('partials.footer')
</body>
</html>
