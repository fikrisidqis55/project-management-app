<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'project_id', 'deadline'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
