<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'foto',
        'name',
        'as',
        'bio',
        'experience',
        'cv_url',
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
