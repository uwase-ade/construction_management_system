@extends('layouts.app')

@section('title', 'Materials')

@section('content')
<div class="page-header">
    <h1>Materials</h1>
    <a href="{{ route('materials.create') }}" class="btn btn-primary">+ New Material</a>
</div>
<div class="card">
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Quantity</th><th>Unit</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($materials as $material)
            <tr>
                <td>{{ $material->material_id }}</td>
                <td>{{ $material->name }}</td>
                <td>{{ number_format($material->quantity, 2) }}</td>
                <td>{{ $material->unit }}</td>
                <td class="inline-actions">
                    <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('materials.destroy', $material) }}" method="POST" onsubmit="return confirm('Delete this material?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No materials found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination">{{ $materials->links() }}</div>
</div>
@endsection
