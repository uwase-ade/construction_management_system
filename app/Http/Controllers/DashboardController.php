<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Material;
use App\Models\Project;
use App\Models\Worker;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'workers' => Worker::count(),
            'materials' => Material::count(),
            'assignments' => Assignment::count(),
            'in_progress' => Project::where('status', 'in_progress')->count(),
            'completed' => Project::where('status', 'completed')->count(),
            'delayed' => Project::where('status', 'delayed')->count(),
        ];

        $recentProjects = Project::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentProjects'));
    }
}
