<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $primaryKey = 'material_id';

    protected $fillable = [
        'name',
        'quantity',
        'unit',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_material', 'material_id', 'project_id', 'material_id', 'project_id')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }
}
