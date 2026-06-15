<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStacks extends Model
{
    protected $table = 'tech_stacks';
    protected $fillable = [
        'name',
    ];
}
