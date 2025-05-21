<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation;

use Filament\Contracts\Plugin;
use Filament\Panel;
use RectitudeOpen\FilamentSiteNavigation\Pages\SiteNavigation;

class FilamentSiteNavigationPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-site-navigation';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                config('filament-site-navigation.filament_page', SiteNavigation::class),
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
