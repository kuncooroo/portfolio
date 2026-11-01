<?php

namespace App\Models;

use App\Models\Concerns\ClearsPortfolioCache;
use App\Models\Concerns\HasPortfolioImage;
use App\Models\Concerns\OrdersContent;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use ClearsPortfolioCache, HasPortfolioImage, OrdersContent;

    protected $fillable = [
        'title',
        'issuer',
        'year',
        'image',
        'description',
        'credential_url',
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
