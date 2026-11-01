<section id="projects" class="section section-doodles">
    <div class="wrap">
        <div style="text-align:center;margin-bottom:3rem">
            <h2 class="heading handwriting heading-wrap">
                Projects
                <svg width="280" height="120" viewBox="0 0 340 170" aria-hidden="true" style="left:-2rem;top:-1.4rem;width:18rem;height:8rem">
                    <path d="M90 28C35 45 18 120 70 145C150 180 280 160 310 90C328 50 305 12 245 18" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </h2>
        </div>
        <div class="project-grid">
            @foreach ($projects as $i => $project)
                <article class="flip-card card">
                    <div class="flip-inner">
                        <div class="flip-face">
                            @include('partials.cover', ['item' => $project, 'index' => $i, 'tall' => true])
                            <h3 class="handwriting">{{ $project->title }}</h3>
                            <p class="meta">{{ $project->subtitle }}</p>
                        </div>
                        <div class="flip-face flip-back">
                            <h3 class="handwriting">{{ $project->title }}</h3>
                            <p>{{ $project->description ?: 'Deskripsi lengkap belum diisi.' }}</p>
                            @if ($project->url)
                                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" style="color:#c4526a;font-size:.8rem;font-weight:800">Buka tautan</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
