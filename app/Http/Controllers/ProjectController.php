<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withCount(['assignments', 'workers'])->latest()->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:planning,in_progress,completed,delayed'],
            'progress_percent' => ['required', 'integer', 'min:0', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['assignments.worker', 'materials']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:planning,in_progress,completed,delayed'],
            'progress_percent' => ['required', 'integer', 'min:0', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function progress(Project $project)
    {
        $materials = Material::orderBy('name')->get();

        return view('projects.progress', compact('project', 'materials'));
    }

    public function updateProgress(Request $request, Project $project)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:planning,in_progress,completed,delayed'],
            'progress_percent' => ['required', 'integer', 'min:0', 'max:100'],
            'materials' => ['nullable', 'array'],
            'materials.*.material_id' => ['required_with:materials', 'exists:materials,material_id'],
            'materials.*.quantity_used' => ['required_with:materials', 'numeric', 'min:0'],
        ]);

        $project->update([
            'status' => $validated['status'],
            'progress_percent' => $validated['progress_percent'],
        ]);

        if (! empty($validated['materials'])) {
            $sync = [];
            foreach ($validated['materials'] as $row) {
                if (! empty($row['material_id'])) {
                    $sync[$row['material_id']] = ['quantity_used' => $row['quantity_used'] ?? 0];
                }
            }
            $project->materials()->sync($sync);
        }

        return redirect()->route('projects.show', $project)->with('success', 'Project progress updated.');
    }
}
