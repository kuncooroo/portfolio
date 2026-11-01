<?php

namespace App\Models;

use App\Models\Concerns\ClearsPortfolioCache;
use App\Models\Concerns\OrdersContent;
use App\Support\Media;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use ClearsPortfolioCache, OrdersContent;

    protected $fillable = [
        'name',
        'icon',
        'category',
        'sort_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    public function usesImage(): bool
    {
        return $this->icon !== null && (str_contains($this->icon, '/') || str_contains($this->icon, '.'));
    }

    public function iconUrl(): ?string
    {
        return $this->usesImage() ? Media::display($this->icon) : null;
    }
}
