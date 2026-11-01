<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'setting' => Setting::current(),
            'counts' => [
                'skills' => Skill::query()->count(),
                'experiences' => Experience::query()->count(),
                'projects' => Project::query()->count(),
                'certificates' => Certificate::query()->count(),
            ],
        ]);
    }
}
