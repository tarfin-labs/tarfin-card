<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\TarfinCard;
use App\Notifications\TarfinCardDeletedNotification;

class TarfinCardObserver
{
    /**
     * Handle the TarfinCard "deleted" event.
     */
    public function deleted(TarfinCard $tarfinCard): void
    {
        $tarfinCard->user->notify(new TarfinCardDeletedNotification($tarfinCard));
    }
}
