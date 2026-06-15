<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return auth()->check() && $user->hasPermission('ViewAny:Projects');
    }

    public function view(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('View:Projects');
    }

    public function create(User $user): bool
    {
        return auth()->check() && $user->hasPermission('Create:Projects');
    }

    public function update(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('Update:Projects');
    }

    public function delete(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('Delete:Projects');
    }
}
