<div class="card">
    <h2>{{ $project->name }}</h2>
    <div class="detail-grid" style="margin-top:1rem">
        <div class="detail-item"><label>Project ID</label><p>{{ $project->project_id }}</p></div>
        <div class="detail-item"><label>Location</label><p>{{ $project->location }}</p></div>
        <div class="detail-item"><label>Status</label><p>{{ $project->status_label }}</p></div>
        <div class="detail-item"><label>Progress</label><p>{{ $project->progress_percent }}%</p></div>
        <div class="detail-item"><label>Start Date</label><p>{{ $project->start_date?->format('d M Y') ?? '—' }}</p></div>
        <div class="detail-item"><label>End Date</label><p>{{ $project->end_date?->format('d M Y') ?? '—' }}</p></div>
    </div>
    @if($project->description)
        <p style="margin-top:1rem"><strong>Description:</strong> {{ $project->description }}</p>
    @endif
</div>

<div class="card">
    <h3 style="margin-bottom:0.75rem">Workers on Project</h3>
    <table>
        <thead><tr><th>Name</th><th>Role</th><th>Assigned</th><th>Notes</th></tr></thead>
        <tbody>
            @forelse($project->assignments as $a)
            <tr>
                <td>{{ $a->worker->name }}</td>
                <td>{{ $a->worker->role }}</td>
                <td>{{ $a->assigned_date?->format('d M Y') ?? '—' }}</td>
                <td>{{ $a->notes ?? '—' }}</td>
            </tr>
            @empty
            <tr><td colspan="4">No workers assigned.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <h3 style="margin-bottom:0.75rem">Materials Usage</h3>
    <table>
        <thead><tr><th>Material</th><th>Qty Used</th><th>Unit</th></tr></thead>
        <tbody>
            @forelse($project->materials as $m)
            <tr>
                <td>{{ $m->name }}</td>
                <td>{{ $m->pivot->quantity_used }}</td>
                <td>{{ $m->unit }}</td>
            </tr>
            @empty
            <tr><td colspan="3">No materials recorded.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
