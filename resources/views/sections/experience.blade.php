@php
    $positions = ['place-1', 'place-2', 'place-3', 'place-4', 'place-5', 'place-6'];
    $tilts = ['tilt-a', 'tilt-b', 'tilt-c', 'tilt-b', 'tilt-a', 'tilt-c'];
@endphp
<section id="experience" class="section section-doodles">
    <div class="wrap">
        <div style="display:flex;justify-content:center;align-items:center;gap:1rem;margin-bottom:3rem">
            <svg width="84" height="24" viewBox="0 0 100 20" aria-hidden="true"><path d="M98 10C70 2 40 18 2 10" fill="none" stroke="#c4526a" stroke-width="2.5" stroke-linecap="round" opacity=".45"/></svg>
            <h2 class="heading handwriting">Experience</h2>
            <svg width="84" height="24" viewBox="0 0 100 20" aria-hidden="true" style="transform:scaleX(-1)"><path d="M98 10C70 2 40 18 2 10" fill="none" stroke="#c4526a" stroke-width="2.5" stroke-linecap="round" opacity=".45"/></svg>
        </div>
        <div class="timeline">
            <div class="timeline-line"></div>
            <div class="scatter">
                @foreach ($experiences as $i => $experience)
                    <article class="{{ $positions[$i % count($positions)] }} card-tilt {{ $tilts[$i % count($tilts)] }}">
                        <div class="dot"></div>
                        <div class="flip-card card">
                            <div class="flip-inner">
                                <div class="flip-face">
                                    @include('partials.cover', ['item' => $experience, 'index' => $i])
                                    <h3 class="handwriting">{{ $experience->title }}</h3>
                                    <p class="meta">{{ $experience->subtitle }}</p>
                                </div>
                                <div class="flip-face flip-back">
                                    <h3 class="handwriting">{{ $experience->title }}</h3>
                                    <p>{{ $experience->description ?: 'Deskripsi lengkap belum diisi.' }}</p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
