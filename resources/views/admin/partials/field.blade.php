<div>
    <label for="{{ $name }}" class="mb-2 block text-sm font-semibold">
        {{ $label }}
        @if (! empty($required))
            <span class="text-[#c4526a]">*</span>
        @endif
    </label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type ?? 'text' }}"
        value="{{ $value ?? '' }}"
        @if (! empty($required)) required @endif
        @if (! empty($placeholder)) placeholder="{{ $placeholder }}" @endif
        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 outline-none ring-[#c4526a] focus:ring-2">
    @error($name)
        <p class="mt-2 text-sm text-[#c4526a]">{{ $message }}</p>
    @enderror
</div>
