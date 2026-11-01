@php
    $preferred = ['dasar', 'klinik', 'edukasi'];
    $labels = [
        'dasar' => 'Dasar',
        'klinik' => 'Klinik',
        'edukasi' => 'Edukasi',
    ];
    $categories = $skills->pluck('category')->unique()->sortBy(function ($category) use ($preferred) {
        $index = array_search($category, $preferred, true);

        return $index === false ? 100 : $index;
    })->values();
@endphp
<section id="skills" class="section section-doodles">
    <div class="wrap">
        <div style="text-align:center">
            <h2 class="heading handwriting heading-wrap">
                Skills
                <svg width="220" height="28" viewBox="0 0 220 28" aria-hidden="true">
                    <path d="M8 16c40 14 90-12 204 2" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </h2>
        </div>
        <div class="filters">
            <div>
                <button type="button" class="is-on" data-filter="all">All</button>
                @foreach ($categories as $category)
                    <button type="button" data-filter="{{ $category }}">{{ $labels[$category] ?? ucfirst($category) }}</button>
                @endforeach
            </div>
        </div>
        <div class="skills">
            @foreach ($skills as $skill)
                <article class="skill" data-skill="{{ $skill->category }}">
                    <div class="skill-bubble">
                        @if ($skill->usesImage() && $skill->iconUrl())
                            <img src="{{ $skill->iconUrl() }}" alt="{{ $skill->name }}" style="width:3rem;height:3rem;object-fit:contain">
                        @elseif ($skill->icon)
                            <i class="{{ $skill->icon }}"></i>
                        @else
                            <span>{{ \Illuminate\Support\Str::of($skill->name)->substr(0, 1) }}</span>
                        @endif
                    </div>
                    <p>{{ $skill->name }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
