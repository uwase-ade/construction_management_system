<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $primaryKey = 'worker_id';

    protected $fillable = [
        'name',
        'role',
        'phone',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'worker_id', 'worker_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'assignments', 'worker_id', 'project_id', 'worker_id', 'project_id')
            ->withPivot('assign_id', 'assigned_date', 'notes')
            ->withTimestamps();
    }
}
