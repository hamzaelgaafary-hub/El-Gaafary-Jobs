<?php

namespace App\Policies;

use App\Models\User;
<<<<<<< HEAD
use App\Models\employer;
=======
use App\Models\Employer;
>>>>>>> 328b122 (First commit from New pulled version)
use Illuminate\Auth\Access\Response;

class EmployerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
<<<<<<< HEAD
        return false;
=======
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(User $user, employer $employer): bool
    {
        return false;
=======
    public function view(User $user, Employer $Employer): bool
    {
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
<<<<<<< HEAD
        return false;
=======
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(User $user, employer $employer): bool
    {
        return false;
=======
    public function update(User $user, Employer $Employer): bool
    {
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(User $user, employer $employer): bool
    {
        return false;
=======
    public function delete(User $user, Employer $Employer): bool
    {
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(User $user, employer $employer): bool
    {
        return false;
=======
    public function restore(User $user, Employer $Employer): bool
    {
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(User $user, employer $employer): bool
    {
        return false;
=======
    public function forceDelete(User $user, Employer $Employer): bool
    {
        return true;
>>>>>>> 328b122 (First commit from New pulled version)
    }
}
