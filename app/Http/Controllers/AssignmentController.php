<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['project', 'worker'])->latest()->paginate(10);

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get();
        $workers = Worker::orderBy('name')->get();

        return view('assignments.create', compact('projects', 'workers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,project_id'],
            'worker_id' => ['required', 'exists:workers,worker_id'],
            'assigned_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $exists = Assignment::where('project_id', $validated['project_id'])
            ->where('worker_id', $validated['worker_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['worker_id' => 'This worker is already assigned to the selected project.'])->withInput();
        }

        Assignment::create($validated);

        return redirect()->route('assignments.index')->with('success', 'Worker assigned to project successfully.');
    }

    public function edit(Assignment $assignment)
    {
        $projects = Project::orderBy('name')->get();
        $workers = Worker::orderBy('name')->get();

        return view('assignments.edit', compact('assignment', 'projects', 'workers'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,project_id'],
            'worker_id' => ['required', 'exists:workers,worker_id'],
            'assigned_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $exists = Assignment::where('project_id', $validated['project_id'])
            ->where('worker_id', $validated['worker_id'])
            ->where('assign_id', '!=', $assignment->assign_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['worker_id' => 'This worker is already assigned to the selected project.'])->withInput();
        }

        $assignment->update($validated);

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment removed successfully.');
    }
}
