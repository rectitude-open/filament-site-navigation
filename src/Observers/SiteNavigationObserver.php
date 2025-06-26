<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Observers;

use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

class SiteNavigationObserver
{
    public static bool $routesAreDirty = false;

    /**
     * Handle the SiteNavigation "created" event.
     */
    public function created(SiteNavigation $siteNavigation): void
    {
        self::$routesAreDirty = true;
    }

    /**
     * Handle the SiteNavigation "updated" event.
     */
    public function updated(SiteNavigation $siteNavigation): void
    {
        self::$routesAreDirty = true;
    }

    /**
     * Handle the SiteNavigation "deleted" event.
     */
    public function deleted(SiteNavigation $siteNavigation): void
    {
        self::$routesAreDirty = true;
    }

    /**
     * Handle the SiteNavigation "restored" event.
     */
    public function restored(SiteNavigation $siteNavigation): void
    {
        self::$routesAreDirty = true;
    }

    /**
     * Handle the SiteNavigation "force deleted" event.
     */
    public function forceDeleted(SiteNavigation $siteNavigation): void
    {
        self::$routesAreDirty = true;
    }
}
