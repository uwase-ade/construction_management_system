@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
</div>

<div class="stats-grid">
    <div class="stat-card"><h3>{{ $stats['projects'] }}</h3><p>Total Projects</p></div>
    <div class="stat-card"><h3>{{ $stats['workers'] }}</h3><p>Workers</p></div>
    <div class="stat-card"><h3>{{ $stats['materials'] }}</h3><p>Materials</p></div>
    <div class="stat-card"><h3>{{ $stats['assignments'] }}</h3><p>Assignments</p></div>
    <div class="stat-card" style="border-color:#ca8a04"><h3>{{ $stats['in_progress'] }}</h3><p>In Progress</p></div>
    <div class="stat-card" style="border-color:#16a34a"><h3>{{ $stats['completed'] }}</h3><p>Completed</p></div>
    <div class="stat-card" style="border-color:#dc2626"><h3>{{ $stats['delayed'] }}</h3><p>Delayed</p></div>
</div>

<div class="card">
    <h2 style="margin-bottom:1rem">Recent Projects</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentProjects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ $project->location }}</td>
                <td><span class="badge badge-{{ $project->status }}">{{ $project->status_label }}</span></td>
                <td>
                    <div class="progress-bar"><span style="width:{{ $project->progress_percent }}%"></span></div>
                    {{ $project->progress_percent }}%
                </td>
                <td><a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-secondary">View</a></td>
            </tr>
            @empty
            <tr><td colspan="5">No projects yet. <a href="{{ route('projects.create') }}">Create one</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
