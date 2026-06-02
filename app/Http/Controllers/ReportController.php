<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $projects = Project::withCount(['assignments', 'workers'])
            ->with('materials')
            ->orderBy('name')
            ->get();

        $summary = [
            'total' => $projects->count(),
            'planning' => $projects->where('status', 'planning')->count(),
            'in_progress' => $projects->where('status', 'in_progress')->count(),
            'completed' => $projects->where('status', 'completed')->count(),
            'delayed' => $projects->where('status', 'delayed')->count(),
            'avg_progress' => round($projects->avg('progress_percent') ?? 0, 1),
        ];

        return view('reports.index', compact('projects', 'summary'));
    }

    public function show(Project $project)
    {
        $project->load(['assignments.worker', 'materials']);

        return view('reports.show', compact('project'));
    }

    public function print(Project $project)
    {
        $project->load(['assignments.worker', 'materials']);

        return view('reports.print', compact('project'));
    }
}
