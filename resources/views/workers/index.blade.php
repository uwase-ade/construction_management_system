@extends('layouts.app')

@section('title', 'Workers')

@section('content')
<div class="page-header">
    <h1>Workers</h1>
    <a href="{{ route('workers.create') }}" class="btn btn-primary">+ New Worker</a>
</div>
<div class="card">
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Role</th><th>Phone</th><th>Assignments</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($workers as $worker)
            <tr>
                <td>{{ $worker->worker_id }}</td>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->role }}</td>
                <td>{{ $worker->phone ?? '—' }}</td>
                <td>{{ $worker->assignments_count }}</td>
                <td class="inline-actions">
                    <a href="{{ route('workers.edit', $worker) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('workers.destroy', $worker) }}" method="POST" onsubmit="return confirm('Delete this worker?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6">No workers found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination">{{ $workers->links() }}</div>
</div>
@endsection
