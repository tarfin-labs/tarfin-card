<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\TarfinCard;
use App\Models\TarfinCardTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TarfinCardTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TarfinCardTransaction $tarfinCardTransaction): bool
    {
        return $user->is($tarfinCardTransaction->tarfinCard->user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, TarfinCard $tarfinCard): bool
    {
        return $user->is($tarfinCard->user);
    }
}
