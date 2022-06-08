<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TarfinCard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TarfinCardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user) && $tarfinCard->transactions()->doesntExist();
    }
}
