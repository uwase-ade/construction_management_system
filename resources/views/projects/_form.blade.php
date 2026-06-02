<div class="form-group">
    <label for="name">Project Name *</label>
    <input type="text" id="name" name="name" value="{{ old('name', $project->name ?? '') }}" required>
</div>
<div class="form-group">
    <label for="location">Location *</label>
    <input type="text" id="location" name="location" value="{{ old('location', $project->location ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status">Status *</label>
    <select id="status" name="status" required>
        @foreach(['planning' => 'Planning', 'in_progress' => 'In Progress', 'completed' => 'Completed', 'delayed' => 'Delayed'] as $val => $label)
            <option value="{{ $val }}" @selected(old('status', $project->status ?? 'planning') === $val)>{{ $label }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="progress_percent">Progress (%) *</label>
    <input type="number" id="progress_percent" name="progress_percent" min="0" max="100" value="{{ old('progress_percent', $project->progress_percent ?? 0) }}" required>
</div>
<div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', isset($project->start_date) ? $project->start_date->format('Y-m-d') : '') }}">
</div>
<div class="form-group">
    <label for="end_date">End Date</label>
    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', isset($project->end_date) ? $project->end_date->format('Y-m-d') : '') }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3">{{ old('description', $project->description ?? '') }}</textarea>
</div>
