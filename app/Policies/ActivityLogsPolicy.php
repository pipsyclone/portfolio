<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return auth()->check() && $user->hasPermission('ViewAny:ActivityLogs');
    }

    public function view(User $user): bool
    {
        return auth()->check() && $user->hasPermission('View:ActivityLogs');
    }

    public function delete(User $user): bool
    {
        return auth()->check() && $user->hasPermission('Delete:ActivityLogs');
    }
}
