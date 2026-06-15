<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TechStacksPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return auth()->check() && $user->hasPermission('ViewAny:TechStacks');
    }

    public function view(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('View:TechStacks');
    }

    public function create(User $user): bool
    {
        return auth()->check() && $user->hasPermission('Create:TechStacks');
    }

    public function update(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('Update:TechStacks');
    }

    public function delete(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('Delete:TechStacks');
    }
}
