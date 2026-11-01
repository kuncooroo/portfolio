<label class="flex items-center gap-3 text-sm font-medium">
    <input type="hidden" name="is_visible" value="0">
    <input type="checkbox" name="is_visible" value="1" class="h-4 w-4 accent-[#c4526a]"
        @checked((string) old('is_visible', $item->exists ? ($item->is_visible ? '1' : '0') : '1') === '1')>
    Tampilkan di website
</label>
