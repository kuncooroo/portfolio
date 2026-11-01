@php
    $washes = ['rose-wash', 'mint-wash', 'blush-wash', 'ink-wash'];
    $wash = $washes[$index % count($washes)];
@endphp
<div class="shot {{ ! empty($tall) ? 'tall' : '' }}">
    <span class="year">{{ $item->year }}</span>
    @if ($item->coverIcon())
        <div class="shot-art {{ $wash }}"><i class="{{ $item->coverIcon() }}"></i></div>
    @elseif ($item->imageUrl())
        <img src="{{ $item->imageUrl() }}" alt="{{ $item->title }}" style="height:100%;width:100%;object-fit:cover">
    @else
        <div class="shot-art {{ $wash }}"><i class="fa-solid fa-tooth"></i></div>
    @endif
</div>
