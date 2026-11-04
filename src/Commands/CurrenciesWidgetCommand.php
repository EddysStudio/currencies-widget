<?php

namespace EddysStudio\CurrenciesWidget\Commands;

use Illuminate\Console\Command;

class CurrenciesWidgetCommand extends Command
{
    public $signature = 'currencies-widget';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
