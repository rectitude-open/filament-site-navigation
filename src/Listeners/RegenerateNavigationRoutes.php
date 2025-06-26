<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Listeners;

use Illuminate\Support\Facades\Artisan;
use RectitudeOpen\FilamentSiteNavigation\Observers\SiteNavigationObserver;

class RegenerateNavigationRoutes
{
    public function handle(): void
    {
        if (SiteNavigationObserver::$routesAreDirty) {
            Artisan::call('nav:generate-routes');
            SiteNavigationObserver::$routesAreDirty = false;
        }
    }
}
