<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Commands;

use Illuminate\Console\Command;

class FilamentSiteNavigationCommand extends Command
{
    public $signature = 'filament-site-navigation';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
