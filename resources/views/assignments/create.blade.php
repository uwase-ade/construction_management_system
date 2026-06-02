@extends('layouts.app')

@section('title', 'New Assignment')

@section('content')
<div class="page-header">
    <h1>Assign Worker to Project</h1>
    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('assignments.store') }}">
        @csrf
        <div class="form-group">
            <label for="project_id">Project *</label>
            <select id="project_id" name="project_id" required>
                <option value="">Select project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" @selected(old('project_id') == $project->project_id)>{{ $project->name }} — {{ $project->location }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="worker_id">Worker *</label>
            <select id="worker_id" name="worker_id" required>
                <option value="">Select worker</option>
                @foreach($workers as $worker)
                    <option value="{{ $worker->worker_id }}" @selected(old('worker_id') == $worker->worker_id)>{{ $worker->name }} ({{ $worker->role }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group"><label for="assigned_date">Assigned Date</label><input type="date" id="assigned_date" name="assigned_date" value="{{ old('assigned_date') }}"></div>
        <div class="form-group"><label for="notes">Notes</label><textarea id="notes" name="notes" rows="2">{{ old('notes') }}</textarea></div>
        <div class="form-actions"><button type="submit" class="btn btn-primary">Create Assignment</button></div>
    </form>
</div>
@endsection
