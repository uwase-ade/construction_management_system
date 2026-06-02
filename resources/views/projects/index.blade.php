@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="page-header">
    <h1>Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">+ New Project</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Workers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>{{ $project->project_id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->location }}</td>
                <td><span class="badge badge-{{ $project->status }}">{{ $project->status_label }}</span></td>
                <td>{{ $project->progress_percent }}%</td>
                <td>{{ $project->assignments_count }}</td>
                <td class="inline-actions">
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-secondary">View</a>
                    <a href="{{ route('projects.progress', $project) }}" class="btn btn-sm btn-primary">Progress</a>
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7">No projects found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination">{{ $projects->links() }}</div>
</div>
@endsection
