<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\TarfinCard;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;

class TarfinCardDeletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public TarfinCard $tarfinCard
    ) {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): Response
    {
        return Http::post(
            url: 'http://you-should-mock-this-mail-service',
            data: [
                'tarfin_card_id' => $this->tarfinCard->id,
                'message'        => "Your Tarfin Card #{$this->tarfinCard->number} is deleted.",
            ]);
    }
}
