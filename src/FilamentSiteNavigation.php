<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation;

use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

class FilamentSiteNavigation
{
    /**
     * @return class-string<SiteNavigation>
     */
    public function getModel(): string
    {
        return config('filament-site-navigation.model', SiteNavigation::class);
    }
}
