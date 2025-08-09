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
use SolutionForest\FilamentTree\Actions\Action;
use SolutionForest\FilamentTree\Pages\TreePage;

class SiteNavigation extends TreePage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static int $maxDepth = 10;

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

    public function getTitle(): string | Htmlable
    {
        return __('filament-site-navigation::filament-site-navigation.resource.label');
    }

    protected function getActions(): array
    {
        return [
            $this->getCreateAction()
                ->modalHeading(fn (): string => __('filament-actions::create.single.modal.heading', ['label' => __('filament-site-navigation::filament-site-navigation.resource.label')]))
                ->label(__('filament-site-navigation::filament-site-navigation.resource.label'))
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label(__('filament-site-navigation::filament-site-navigation.field.title'))
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('path')
                ->label(__('filament-site-navigation::filament-site-navigation.field.path'))
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            Grid::make(['sm' => 2])
                ->schema([
                    ToggleButtons::make('is_active')
                        ->label(__('filament-site-navigation::filament-site-navigation.field.active_status'))
                        ->options([
                            1 => __('filament-site-navigation::filament-site-navigation.field.active_status_active'),
                            0 => __('filament-site-navigation::filament-site-navigation.field.active_status_inactive'),
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
                        ->label(__('filament-site-navigation::filament-site-navigation.field.visibility_status'))
                        ->options([
                            1 => __('filament-site-navigation::filament-site-navigation.field.visibility_status_visible'),
                            0 => __('filament-site-navigation::filament-site-navigation.field.visibility_status_hidden'),
                        ])
                        ->default(1)
                        ->colors([
                            1 => 'success',
                            0 => 'warning',
                        ])
                        ->icons([
                            1 => 'heroicon-o-eye',
                            0 => 'heroicon-o-eye-slash',
                        ])
                        ->inline(),
                ]),
            Section::make(__('filament-site-navigation::filament-site-navigation.info.route_configuration'))
                ->compact()
                ->schema([
                    TextInput::make('controller_action')
                        ->label(__('filament-site-navigation::filament-site-navigation.field.controller_action'))
                        ->placeholder('App\Http\Controllers\PageController@show')
                        ->columnSpanFull(),
                    KeyValue::make('route_parameters')
                        ->label(__('filament-site-navigation::filament-site-navigation.field.route_parameters'))
                        ->keyLabel(__('filament-site-navigation::filament-site-navigation.info.route_parameters_key_label'))
                        ->valueLabel(__('filament-site-navigation::filament-site-navigation.info.route_parameters_value_label')),
                    KeyValue::make('child_routes')
                        ->label(__('filament-site-navigation::filament-site-navigation.field.child_routes'))
                        ->keyLabel(__('filament-site-navigation::filament-site-navigation.info.child_routes_key_label'))
                        ->valueLabel(__('filament-site-navigation::filament-site-navigation.info.child_routes_value_label')),
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
            Action::make('duplicate')
                ->hiddenLabel()
                ->icon('heroicon-o-document-duplicate')
                ->iconButton()
                ->action(function ($record) {
                    $newRecord = $record->replicate();
                    $newRecord->created_at = now();
                    $newRecord->updated_at = now();
                    $newRecord->save();
                })
                ->requiresConfirmation(),
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
