<?php

namespace App\Support;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Support\Facades\Cache;

class PortfolioPage
{
    public static function data(): array
    {
        return [
            'setting' => Setting::current(),
            'skills' => Skill::query()->visible()->ordered()->get(),
            'experiences' => Experience::query()->visible()->ordered()->get(),
            'projects' => Project::query()->visible()->ordered()->get(),
            'certificates' => Certificate::query()->visible()->ordered()->get(),
        ];
    }

    public static function forget(): void
    {
        self::store()->forget('portfolio.page');
    }

    private static function store()
    {
        $name = app()->runningUnitTests() ? config('cache.default') : 'file';

        return Cache::store($name);
    }
}
