<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation;

use Illuminate\Database\Eloquent\Model;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

class FilamentSiteNavigation
{
    /**
     * @return class-string<Model>
     */
    public function getModel(): string
    {
        return config('filament-site-navigation.model', SiteNavigation::class);
    }
}
