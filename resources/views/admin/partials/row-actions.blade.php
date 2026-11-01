<div class="flex items-center justify-end gap-2">
    <form method="POST" action="{{ route($route.'.move', $model) }}">
        @csrf
        <input type="hidden" name="direction" value="up">
        <button class="rounded-lg border border-gray-200 px-2 py-1 text-xs hover:border-black" title="Naikkan">↑</button>
    </form>
    <form method="POST" action="{{ route($route.'.move', $model) }}">
        @csrf
        <input type="hidden" name="direction" value="down">
        <button class="rounded-lg border border-gray-200 px-2 py-1 text-xs hover:border-black" title="Turunkan">↓</button>
    </form>
    <a href="{{ route($route.'.edit', $model) }}" class="rounded-lg border border-gray-200 px-3 py-1 text-xs font-semibold hover:border-black">Edit</a>
    <form method="POST" action="{{ route($route.'.destroy', $model) }}" onsubmit="return confirm('Hapus data ini?')">
        @csrf
        @method('DELETE')
        <button class="rounded-lg px-3 py-1 text-xs font-semibold text-[#c4526a] hover:bg-red-50">Hapus</button>
    </form>
</div>
