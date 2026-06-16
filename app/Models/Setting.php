<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $casts = [
        'app_logo' => 'array',
    ];

    protected $fillable = [
        'app_name',
        'app_name_short',
        'app_color',
        'app_logo',
        'app_favicon',
        'app_stempel',
        'app_background_login_image',
        'youtube_link',
        'instagram_link',
        'tiktok_link',
        'facebook_link',
        'x_twitter_link',
        'github_link',
        'linkedin_link',
    ];
}
