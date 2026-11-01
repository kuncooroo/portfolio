<?php

namespace App\Models\Concerns;

trait OrdersContent
{
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public static function nextSortOrder(): int
    {
        return (int) static::query()->max('sort_order') + 1;
    }

    public static function moveItem(int $id, string $direction): void
    {
        $items = static::query()->ordered()->get()->values();
        $index = $items->search(fn ($item) => $item->id === $id);
        $swapIndex = $direction === 'up' ? $index - 1 : $index + 1;

        if ($index === false || $swapIndex < 0 || $swapIndex >= $items->count()) {
            return;
        }

        $reordered = $items->all();
        [$reordered[$index], $reordered[$swapIndex]] = [$reordered[$swapIndex], $reordered[$index]];

        foreach (array_values($reordered) as $position => $item) {
            $order = $position + 1;

            if ((int) $item->sort_order !== $order) {
                $item->update(['sort_order' => $order]);
            }
        }
    }
}
