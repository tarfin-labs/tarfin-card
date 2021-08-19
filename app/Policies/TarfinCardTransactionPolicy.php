<?php

namespace App\Policies;

use App\Models\TarfinCard;
use App\Models\TarfinCardTransaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TarfinCardTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\TarfinCard  $tarfinCard
     *
     * @return bool
     */
    public function viewAny(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User                   $user
     * @param  \App\Models\TarfinCardTransaction  $tarfinCardTransaction
     *
     * @return bool
     */
    public function view(User $user, TarfinCardTransaction $tarfinCardTransaction): bool
    {
        return $user->is($tarfinCardTransaction->tarfinCard->user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User        $user
     * @param  \App\Models\TarfinCard  $tarfinCard
     *
     * @return bool
     */
    public function create(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user);
    }
}
