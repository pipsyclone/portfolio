<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    protected $table = 'specializations';
    protected $fillable = [
        'name',
    ];
}
