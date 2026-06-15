<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    protected $table = 'specializations';
    protected $fillable = [
        'name',
    ];

    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'project_specialization', 'specialization_id', 'project_id');
    }
}
