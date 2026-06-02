@extends('layouts.app')

@section('title', 'Edit Assignment')

@section('content')
<div class="page-header">
    <h1>Edit Assignment</h1>
    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('assignments.update', $assignment) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="project_id">Project *</label>
            <select id="project_id" name="project_id" required>
                @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" @selected(old('project_id', $assignment->project_id) == $project->project_id)>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="worker_id">Worker *</label>
            <select id="worker_id" name="worker_id" required>
                @foreach($workers as $worker)
                    <option value="{{ $worker->worker_id }}" @selected(old('worker_id', $assignment->worker_id) == $worker->worker_id)>{{ $worker->name }} ({{ $worker->role }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group"><label for="assigned_date">Assigned Date</label><input type="date" id="assigned_date" name="assigned_date" value="{{ old('assigned_date', $assignment->assigned_date?->format('Y-m-d')) }}"></div>
        <div class="form-group"><label for="notes">Notes</label><textarea id="notes" name="notes" rows="2">{{ old('notes', $assignment->notes) }}</textarea></div>
        <div class="form-actions"><button type="submit" class="btn btn-primary">Update Assignment</button></div>
    </form>
</div>
@endsection
