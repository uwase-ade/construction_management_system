<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::withCount('assignments')->latest()->paginate(10);

        return view('workers.index', compact('workers'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Worker::create($validated);

        return redirect()->route('workers.index')->with('success', 'Worker created successfully.');
    }

    public function edit(Worker $worker)
    {
        return view('workers.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $worker->update($validated);

        return redirect()->route('workers.index')->with('success', 'Worker updated successfully.');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();

        return redirect()->route('workers.index')->with('success', 'Worker deleted successfully.');
    }
}
