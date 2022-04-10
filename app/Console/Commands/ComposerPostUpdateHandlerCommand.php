<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ComposerPostUpdateHandlerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle Composer post-update event for ide-helper';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (app()->environment(['local'])) {
            $this->call('ide-helper:generate', ['--quiet' => true]);
            $this->call('ide-helper:meta', ['--quiet' => true]);
            $this->call('ide-helper:models', ['--nowrite' => true, '--write-mixin' => true, '--quiet' => true]);
            $this->call('ide-helper:eloquent', ['--quiet' => true]);
        }
    }
}
