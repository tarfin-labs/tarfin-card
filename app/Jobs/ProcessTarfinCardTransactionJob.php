<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessTarfinCardTransactionJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $tarfinCardTransaction,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Http::post(
            url: 'http://you-should-mock-this-job',
            data: ['tarfin_card_transaction_id' => $this->tarfinCardTransactionId],
        );
    }
}
