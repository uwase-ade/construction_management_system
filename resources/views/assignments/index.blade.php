@extends('layouts.app')

@section('title', 'Assignments')

@section('content')
<div class="page-header">
    <h1>Worker Assignments</h1>
    <a href="{{ route('assignments.create') }}" class="btn btn-primary">+ New Assignment</a>
</div>
<div class="card">
    <table>
        <thead>
            <tr><th>ID</th><th>Project</th><th>Worker</th><th>Role</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($assignments as $assignment)
            <tr>
                <td>{{ $assignment->assign_id }}</td>
                <td>{{ $assignment->project->name }}</td>
                <td>{{ $assignment->worker->name }}</td>
                <td>{{ $assignment->worker->role }}</td>
                <td>{{ $assignment->assigned_date?->format('d M Y') ?? '—' }}</td>
                <td class="inline-actions">
                    <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" onsubmit="return confirm('Remove this assignment?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6">No assignments found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination">{{ $assignments->links() }}</div>
</div>
@endsection
