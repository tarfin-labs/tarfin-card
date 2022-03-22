<?php

namespace App\Observers;

use App\Models\TarfinCard;
use App\Notifications\TarfinCardDeletedNotification;

class TarfinCardObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the TarfinCard "deleted" event.
     *
     * @param  \App\Models\TarfinCard  $tarfinCard
     * @return void
     */
    public function deleted(TarfinCard $tarfinCard): void
    {
        $tarfinCard->user->notify(new TarfinCardDeletedNotification($tarfinCard));
    }
}
