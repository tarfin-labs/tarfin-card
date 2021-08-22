<?php

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

    protected int $tarfinCardTransactionId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $tarfinCardTransaction)
    {
        $this->tarfinCardTransactionId = $tarfinCardTransaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Http::post('http://you-should-mock-this-job', [
            'tarfin_card_transaction_id' => $this->tarfinCardTransactionId,
        ]);
    }
}
