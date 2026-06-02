<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $primaryKey = 'assign_id';

    protected $fillable = [
        'project_id',
        'worker_id',
        'assigned_date',
        'notes',
    ];

    protected $casts = [
        'assigned_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id', 'worker_id');
    }
}
