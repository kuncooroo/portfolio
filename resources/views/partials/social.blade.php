@if ($setting->hasSocialLinks())
    <aside class="social" aria-label="Kontak">
        @if ($setting->instagram)
            <a href="{{ $setting->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        @endif
        @if ($setting->whatsapp)
            <a href="{{ $setting->whatsapp }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
        @endif
        @if ($setting->email)
            <a href="mailto:{{ $setting->email }}" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
        @endif
        @if ($setting->linkedin)
            <a href="{{ $setting->linkedin }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
        @endif
    </aside>
@endif
