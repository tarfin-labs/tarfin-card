<?php

namespace App\Observers;

use App\Models\TarfinCard;
use App\Notifications\TarfinCardCreatedNotification;

class TarfinCardObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the TarfinCard "created" event.
     *
     * @param  \App\Models\TarfinCard  $tarfinCard
     * @return void
     */
    public function created(TarfinCard $tarfinCard): void
    {
        $tarfinCard->user->notify(new TarfinCardCreatedNotification($tarfinCard));
    }
}
