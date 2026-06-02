@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="page-header">
    <h1>Project Reports</h1>
</div>

<div class="stats-grid">
    <div class="stat-card"><h3>{{ $summary['total'] }}</h3><p>Total Projects</p></div>
    <div class="stat-card"><h3>{{ $summary['in_progress'] }}</h3><p>In Progress</p></div>
    <div class="stat-card"><h3>{{ $summary['completed'] }}</h3><p>Completed</p></div>
    <div class="stat-card"><h3>{{ $summary['delayed'] }}</h3><p>Delayed</p></div>
    <div class="stat-card"><h3>{{ $summary['avg_progress'] }}%</h3><p>Average Progress</p></div>
</div>

<div class="card">
    <h2 style="margin-bottom:1rem">All Projects Summary</h2>
    <table>
        <thead>
            <tr>
                <th>Project</th>
                <th>Location</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Workers</th>
                <th>Report</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ $project->location }}</td>
                <td><span class="badge badge-{{ $project->status }}">{{ $project->status_label }}</span></td>
                <td>{{ $project->progress_percent }}%</td>
                <td>{{ $project->assignments_count }}</td>
                <td class="inline-actions">
                    <a href="{{ route('reports.show', $project) }}" class="btn btn-sm btn-primary">View Report</a>
                    <a href="{{ route('reports.print', $project) }}" class="btn btn-sm btn-secondary" target="_blank">Print</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
