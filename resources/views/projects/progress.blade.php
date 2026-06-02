@extends('layouts.app')

@section('title', 'Track Progress')

@section('content')
<div class="page-header">
    <h1>Track Progress — {{ $project->name }}</h1>
    <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('projects.progress.update', $project) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                @foreach(['planning', 'in_progress', 'completed', 'delayed'] as $val)
                    <option value="{{ $val }}" @selected(old('status', $project->status) === $val)>{{ ucfirst(str_replace('_', ' ', $val)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="progress_percent">Progress (%)</label>
            <input type="number" id="progress_percent" name="progress_percent" min="0" max="100" value="{{ old('progress_percent', $project->progress_percent) }}" required>
        </div>

        <h3 style="margin:1.5rem 0 1rem">Materials Used on This Project</h3>
        @php
            $existing = $project->materials->keyBy('material_id');
        @endphp
        @foreach($materials as $index => $material)
        <div class="form-group" style="display:flex;gap:1rem;align-items:center;flex-wrap:wrap">
            <input type="hidden" name="materials[{{ $index }}][material_id]" value="{{ $material->material_id }}">
            <label style="min-width:200px">{{ $material->name }} (stock: {{ $material->quantity }} {{ $material->unit }})</label>
            <input type="number" name="materials[{{ $index }}][quantity_used]" min="0" step="0.01"
                value="{{ old('materials.'.$index.'.quantity_used', $existing->get($material->material_id)?->pivot->quantity_used ?? 0) }}"
                placeholder="Quantity used" style="max-width:150px">
        </div>
        @endforeach

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Progress</button>
        </div>
    </form>
</div>
@endsection
