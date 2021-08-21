<?php

namespace App\Jobs;

use App\Models\TarfinCardTransaction;
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

    protected TarfinCardTransaction $tarfinCardTransaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TarfinCardTransaction $tarfinCardTransaction)
    {
        $this->tarfinCardTransaction = $tarfinCardTransaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Http::post('http://you-should-mock-this-job', $this->tarfinCardTransaction->id);
    }
}
