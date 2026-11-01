<section id="certificates" class="section section-doodles" style="padding-bottom:4rem">
    <div class="wrap">
        <div style="text-align:center;margin-bottom:3rem">
            <h2 class="heading handwriting heading-wrap">
                Certificates
                <svg width="340" height="130" viewBox="0 0 430 180" aria-hidden="true" style="left:-1.5rem;top:-1.2rem;width:22rem;height:8rem">
                    <path d="M42 40C55 20 355 18 385 38C405 55 402 130 380 145C360 160 72 165 45 145C20 128 18 58 42 40" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </h2>
        </div>
        <div class="cert-grid">
            @foreach ($certificates as $i => $certificate)
                <article class="flip-card" style="width:14rem">
                    <div class="flip-inner">
                        <div class="flip-face">
                            @include('partials.cover', ['item' => $certificate, 'index' => $i])
                            <h3 class="handwriting" style="font-size:1.8rem">{{ $certificate->title }}</h3>
                            <p class="meta">{{ $certificate->issuer }}</p>
                        </div>
                        <div class="flip-face flip-back">
                            <h3 class="handwriting">{{ $certificate->title }}</h3>
                            <p>{{ $certificate->description ?: 'Deskripsi lengkap belum diisi.' }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
