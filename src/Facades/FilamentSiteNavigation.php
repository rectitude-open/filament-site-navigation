<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RectitudeOpen\FilamentSiteNavigation\FilamentSiteNavigation
 */
class FilamentSiteNavigation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RectitudeOpen\FilamentSiteNavigation\FilamentSiteNavigation::class;
    }
}
