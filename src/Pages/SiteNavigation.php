<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation as TreePageModel;
use SolutionForest\FilamentTree\Pages\TreePage;

class SiteNavigation extends TreePage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public function getModel(): string
    {
        return config('filament-site-navigation.model', TreePageModel::class);
    }

    public static function getNavigationIcon(): string | Htmlable | null
    {
        return static::$navigationIcon ?? config('filament-site-navigation.navigation_icon', 'heroicon-o-square-3-stack-3d');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-site-navigation.navigation_sort', 0);
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-site-navigation::filament-site-navigation.nav.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-site-navigation::filament-site-navigation.nav.group');
    }

    protected static int $maxDepth = 3;

    protected function getActions(): array
    {
        return [
            $this->getCreateAction()->icon('heroicon-o-plus'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('path')
                ->label(__('Path'))
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->columnSpanFull(),
            Grid::make(['sm' => 2])
                ->schema([
                    ToggleButtons::make('is_active')
                        ->options([
                            1 => 'Active',
                            0 => 'Inactive',
                        ])
                        ->default(1)
                        ->colors([
                            1 => 'success',
                            0 => 'warning',
                        ])
                        ->icons([
                            1 => 'heroicon-o-check-circle',
                            0 => 'heroicon-o-x-circle',
                        ])
                        ->inline(),
                    ToggleButtons::make('is_visible')
                        ->options([
                            1 => 'Visible',
                            0 => 'Hidden',
                        ])
                        ->default(1)
                        ->colors([
                            1 => 'success',
                            0 => 'warning',
                        ])
                        ->icons([
                            1 => 'heroicon-o-eye',
                            0 => 'heroicon-o-eye-off',
                        ])
                        ->inline(),
                ]),
            Section::make('Route Configuration')
                ->label(__('Route Configuration'))
                ->compact()
                ->schema([
                    TextInput::make('controller_action')
                        ->label(__('Controller Action'))
                        ->placeholder('App\Http\Controllers\PageController@show')
                        ->columnSpanFull(),
                    KeyValue::make('route_parameters')
                        ->label('Route Parameters')
                        ->keyLabel('Parameter Name')
                        ->valueLabel('Parameter Value')
                        ->reorderable(),
                    KeyValue::make('child_routes')
                        ->label('Child Routes')
                        ->keyLabel('Route Pattern')
                        ->valueLabel('Controller Action'),
                ])
                ->collapsed(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    /**
     * @param  \RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation|null  $record
     */
    public function getTreeRecordTitle(?Model $record = null): string
    {
        if (! $record) {
            return '';
        }

        $id = $record->id ? " [ID: {$record->id}]" : '';
        $title = $record->title ?? '';
        $path = $record->path ? ' - ' . $record->path : '';
        $activeIcon = $record->is_active ? '' : '🚫';
        $visibleIcon = $record->is_visible ? '' : '🔇';

        return "$id $title$path $activeIcon$visibleIcon";
    }

    protected function getTreeActions(): array
    {
        return [
            $this->getEditAction(),
            $this->getDeleteAction(),
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        $admin = Filament::auth()->user();

        // @phpstan-ignore-next-line
        return $admin->hasRole('super-admin') || $admin->can(static::getPermissionName());
    }
}
