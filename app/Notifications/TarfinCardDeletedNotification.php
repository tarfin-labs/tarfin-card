<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\TarfinCard;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Client\Response;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class TarfinCardDeletedNotification extends Notification
{
    use Queueable;

    public TarfinCard $tarfinCard;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TarfinCard $tarfinCard)
    {
        $this->tarfinCard = $tarfinCard;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     */
    public function toMail($notifiable): Response
    {
        return Http::post('http://you-should-mock-this-mail-service', [
            'tarfin_card_id' => $this->tarfinCard->id,
            'message'        => "Your Tarfin Card #{$this->tarfinCard->number} is deleted.",
        ]);
    }
}
