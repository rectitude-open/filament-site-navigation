<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use RectitudeOpen\FilamentSiteNavigation\Commands\FilamentSiteNavigationCommand;
use RectitudeOpen\FilamentSiteNavigation\Commands\GenerateNavigationRoutes;
use RectitudeOpen\FilamentSiteNavigation\Listeners\RegenerateNavigationRoutes;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation as SiteNavigationModel;
use RectitudeOpen\FilamentSiteNavigation\Observers\SiteNavigationObserver;
use RectitudeOpen\FilamentSiteNavigation\Testing\TestsFilamentSiteNavigation;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSiteNavigationServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-site-navigation';

    public static string $viewNamespace = 'filament-site-navigation';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations();
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        SiteNavigationModel::observe(SiteNavigationObserver::class);

        $this->app->terminating(function () {
            $this->app[Dispatcher::class]->dispatch('filament-site-navigation.terminating');
        });
        $this->app['events']->listen('filament-site-navigation.terminating', RegenerateNavigationRoutes::class);

        // Asset Registration
        // FilamentAsset::register(
        //     $this->getAssets(),
        //     $this->getAssetPackageName()
        // );

        // FilamentAsset::registerScriptData(
        //     $this->getScriptData(),
        //     $this->getAssetPackageName()
        // );

        // Icon Registration
        // FilamentIcon::register($this->getIcons());

        // // Handle Stubs
        // if (app()->runningInConsole()) {
        //     foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
        //         $this->publishes([
        //             $file->getRealPath() => base_path("stubs/filament-site-navigation/{$file->getFilename()}"),
        //         ], 'filament-site-navigation-stubs');
        //     }
        // }

        // Testing
        // Testable::mixin(new TestsFilamentSiteNavigation);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'rectitude-open/filament-site-navigation';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-site-navigation', __DIR__ . '/../resources/dist/components/filament-site-navigation.js'),
            // Css::make('filament-site-navigation-styles', __DIR__ . '/../resources/dist/filament-site-navigation.css'),
            // Js::make('filament-site-navigation-scripts', __DIR__ . '/../resources/dist/filament-site-navigation.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            // FilamentSiteNavigationCommand::class,
            GenerateNavigationRoutes::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_site_navigations_table',
        ];
    }
}
