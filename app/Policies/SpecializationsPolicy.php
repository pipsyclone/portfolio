<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecializationsPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return auth()->check() && $user->hasPermission('ViewAny:Specializations');
    }

    public function view(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('View:Specializations');
    }

    public function create(User $user): bool
    {
        return auth()->check() && $user->hasPermission('Create:Specializations');
    }

    public function update(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('Update:Specializations');
    }

    public function delete(User $user, $model): bool
    {
        return auth()->check() && $user->hasPermission('Delete:Specializations');
    }
}
