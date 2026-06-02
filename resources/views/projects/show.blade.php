@extends('layouts.app')

@section('title', $project->name)

@section('content')
<div class="page-header">
    <h1>{{ $project->name }}</h1>
    <div class="inline-actions no-print">
        <a href="{{ route('projects.progress', $project) }}" class="btn btn-primary">Update Progress</a>
        <a href="{{ route('reports.show', $project) }}" class="btn btn-secondary">Report</a>
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card">
    <div class="detail-grid">
        <div class="detail-item"><label>Project ID</label><p>{{ $project->project_id }}</p></div>
        <div class="detail-item"><label>Location</label><p>{{ $project->location }}</p></div>
        <div class="detail-item"><label>Status</label><p><span class="badge badge-{{ $project->status }}">{{ $project->status_label }}</span></p></div>
        <div class="detail-item"><label>Progress</label><p>{{ $project->progress_percent }}%</p></div>
        <div class="detail-item"><label>Start Date</label><p>{{ $project->start_date?->format('d M Y') ?? '—' }}</p></div>
        <div class="detail-item"><label>End Date</label><p>{{ $project->end_date?->format('d M Y') ?? '—' }}</p></div>
    </div>
    @if($project->description)
        <p style="margin-top:1rem"><strong>Description:</strong> {{ $project->description }}</p>
    @endif
    <div class="progress-bar" style="margin-top:1rem;height:12px"><span style="width:{{ $project->progress_percent }}%"></span></div>
</div>

<div class="card">
    <h2 style="margin-bottom:1rem">Assigned Workers</h2>
    <table>
        <thead><tr><th>Worker</th><th>Role</th><th>Assigned Date</th><th>Notes</th></tr></thead>
        <tbody>
            @forelse($project->assignments as $assignment)
            <tr>
                <td>{{ $assignment->worker->name }}</td>
                <td>{{ $assignment->worker->role }}</td>
                <td>{{ $assignment->assigned_date?->format('d M Y') ?? '—' }}</td>
                <td>{{ $assignment->notes ?? '—' }}</td>
            </tr>
            @empty
            <tr><td colspan="4">No workers assigned. <a href="{{ route('assignments.create') }}">Create assignment</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <h2 style="margin-bottom:1rem">Materials Usage</h2>
    <table>
        <thead><tr><th>Material</th><th>Quantity Used</th><th>Unit</th></tr></thead>
        <tbody>
            @forelse($project->materials as $material)
            <tr>
                <td>{{ $material->name }}</td>
                <td>{{ $material->pivot->quantity_used }}</td>
                <td>{{ $material->unit }}</td>
            </tr>
            @empty
            <tr><td colspan="3">No materials recorded. <a href="{{ route('projects.progress', $project) }}">Update progress</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
