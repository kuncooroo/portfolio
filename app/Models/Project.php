<?php

namespace App\Models;

use App\Models\Concerns\ClearsPortfolioCache;
use App\Models\Concerns\HasPortfolioImage;
use App\Models\Concerns\OrdersContent;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use ClearsPortfolioCache, HasPortfolioImage, OrdersContent;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'year',
        'image',
        'url',
        'sort_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }
}
