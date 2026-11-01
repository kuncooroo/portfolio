@php
    $bioPlain = trim(preg_replace('/\s+/', ' ', strip_tags((string) $setting->bio)));
    $roles = collect(preg_split('/\s*[•|]\s*/', (string) $setting->roles) ?: [])
        ->map(fn ($role) => trim($role))
        ->filter()
        ->values();
@endphp
<section id="about" class="hero">
    <div class="hero-doodles" aria-hidden="true">
        <span class="hero-doodle hero-doodle-a">edisi 01</span>
        <span class="hero-doodle hero-doodle-b">{{ $setting->caption_secondary }}</span>
        <span class="hero-doodle hero-doodle-c">baca pelan</span>
    </div>
    <div class="hero-sheet">
        <aside class="hero-col hero-col-left">
            <p class="hero-kicker">sedikit tentang aku</p>
            <h1>{{ $setting->owner_name }}</h1>
            <p class="hero-lead">{{ $bioPlain }}</p>
        </aside>
        @if ($setting->photoUrl())
            <img class="hero-portrait" src="{{ $setting->photoUrl() }}" alt="Ilustrasi {{ $setting->owner_name }}">
        @endif
        <aside class="hero-col hero-col-right">
            <p class="hero-kicker">di edisi ini</p>
            <ul class="hero-roles">
                @foreach ($roles as $role)
                    <li>{{ $role }}</li>
                @endforeach
            </ul>
            <p class="hero-note">{{ $setting->caption_primary }}</p>
            <p class="hero-sign">{{ $setting->greeting }}</p>
        </aside>
    </div>
</section>
