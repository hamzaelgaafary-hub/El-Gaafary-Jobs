<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->IsJobSeeker() || $user->IsAdmin() || $user->IsEmployer();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $Job): bool
    {
        return $user->IsJobSeeker() || $user->IsAdmin() || ($user->IsEmployer() &&  $Job->Employer->user->id === $user->id);
        //$Job->Employer->user->id === $user->id);
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
    public function update(User $user, Job $Job): bool
    {
        return $user->IsAdmin() || ($user->IsEmployer() &&  $Job->Employer->user->id === $user->id);
        //);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $Job): bool
    {
        return $user->IsAdmin() || ($user->IsEmployer() && $Job->Employer->user->id === $user->id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $Job): bool
    {
        return $user->IsAdmin() || ($user->IsEmployer() && $Job->Employer->user->id === $user->id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $Job): bool
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
