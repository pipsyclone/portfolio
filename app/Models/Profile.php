<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasUuids;

    protected $table = 'profile';

    protected $fillable = [
        'foto',
        'name',
        'as',
        'bio',
        'experience',
        'cv',
        'email',
        'phone',
        'address',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skills::class, 'skills', 'profile_id', 'skill_id');
    }
}
