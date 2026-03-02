<?php

namespace App\Policies;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmployerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->IsJobSeeker() || $user->IsAdmin() || $user->IsEmployer();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Employer $Employer): bool
    {
        return $user->IsJobSeeker() || $user->IsAdmin() || $user->IsEmployer();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->IsAdmin() || $user->IsEmployer();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employer $Employer): bool
    {
        return $user->IsAdmin() || ($user->IsEmployer() && $Employer->user_id === $user->id);
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Employer $Employer): bool
    {
        return $user->IsAdmin() || ($user->IsEmployer() && $Employer->id === $user->Employer->id);
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Employer $Employer): bool
    {
        return $user->IsAdmin() || ($user->IsEmployer() && $Employer->id === $user->Employer->id);
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Employer $Employer): bool
    {
        return $user->IsAdmin();
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->IsAdmin();

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->IsAdmin();

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->IsAdmin();

    }
}
