# This is my package filament-site-navigation

![Do not use](https://img.shields.io/badge/Under%20development-Don't%20use-red)
[![Tests](https://github.com/rectitude-open/filament-site-navigation/actions/workflows/run-tests.yml/badge.svg)](https://github.com/rectitude-open/filament-site-navigation/actions/workflows/run-tests.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%205-brightgreen)](https://phpstan.org/)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/rectitude-open/filament-site-navigation.svg?style=flat-square)](https://packagist.org/packages/rectitude-open/filament-site-navigation)
[![Total Downloads](https://img.shields.io/packagist/dt/rectitude-open/filament-site-navigation.svg?style=flat-square)](https://packagist.org/packages/rectitude-open/filament-site-navigation)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](https://github.com/rectitude-open/filament-site-navigation/pulls)

Generate a banner for your package using [Social Image Generator for Open Source packages](https://banners.beyondco.de/)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

Resource | Page | Cluster | Migration | Model | Config | View | Localization
--- | --- | --- | --- | --- | --- | --- | ---
❌ | ✅| ❌ | ✅ | ✅ | ✅ | ❌ | ✅  

## Installation

You can install the package via composer:

```bash
composer require rectitude-open/filament-site-navigation
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-site-navigation-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-site-navigation-config"
```

Optionally, you can publish the translations using

```bash
php artisan vendor:publish --tag="filament-site-navigation-translations"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

The package provides a resource page that allows you to view XXXXXXX in your Filament admin panel. 

To use the resource page provided by this package, you need to register it in your Panel Provider first.

```php
namespace App\Providers\Filament;

use RectitudeOpen\FilamentSiteNavigation\FilamentSiteNavigationPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->plugins([
                FilamentSiteNavigationPlugin::make()
            ]);
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Aspirant Zhang](https://github.com/aspirantzhang)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
