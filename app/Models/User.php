<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'foto',
        'name',
        'email',
        'phone',
        'headline',
        'keywords',
        'about_image',
        'about_title',
        'about_description',
        'about_extra_information',
        'experience',
        'careers',
        'address',
        'specialis',
        'cv_file',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'about_extra_information' => 'array',
            'careers' => 'array',
        ];
    }

    // Method
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->foto
            ? asset('storage/'.$this->foto)
            : null;
    }

    public function hasRoles($roles): array
    {
        return $this->roles()->whereIn('slug', (array) $roles)->pluck('slug')->toArray();
    }

    public function hasPermission(string $permissionName): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permissionName) {
                $query->where('name', $permissionName);
            })
            ->exists();
    }

    public static function createLog(
        Request $request,
        string $activity,
        ?string $description = null,
    ): void {
        ActivityLogs::create([
            'user_id' => auth()->id(),
            'activity' => $activity,
            'ip_address' => $request->ipLocation(),
            'user_agent' => $request->userAgent(),
            'description' => $description,
        ]);
    }

    // Relationship
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'user_has_roles', 'user_id', 'role_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLogs::class);
    }
}
