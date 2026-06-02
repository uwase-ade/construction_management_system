<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'name',
        'location',
        'status',
        'progress_percent',
        'start_date',
        'end_date',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'project_id', 'project_id');
    }

    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'assignments', 'project_id', 'worker_id', 'project_id', 'worker_id')
            ->withPivot('assign_id', 'assigned_date', 'notes')
            ->withTimestamps();
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'project_material', 'project_id', 'material_id', 'project_id', 'material_id')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'planning' => 'Planning',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'delayed' => 'Delayed',
            default => ucfirst($this->status),
        };
    }
}
