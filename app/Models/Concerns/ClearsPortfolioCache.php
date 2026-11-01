<?php

namespace App\Models\Concerns;

use App\Support\PortfolioPage;

trait ClearsPortfolioCache
{
    protected static function bootClearsPortfolioCache(): void
    {
        $forget = static function () {
            PortfolioPage::forget();
        };

        static::saved($forget);
        static::deleted($forget);
    }
}
