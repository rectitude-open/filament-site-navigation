<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

/**
 * @property string $title
 * @property string $path
 * @property string $controller_action
 * @property array $route_parameters
 * @property string $child_route_pattern
 * @property string $child_controller_action
 * @property int $is_active
 * @property int $is_visible
 * @property int $parent_id
 * @property int $weight
 *
 * @method static \Illuminate\Database\Eloquent\Builder|static active()
 * @method static \Illuminate\Database\Eloquent\Builder|static inactive()
 * @method static \Illuminate\Database\Eloquent\Builder|static visible()
 * @method static \Illuminate\Database\Eloquent\Builder|static hidden()
 */
class SiteNavigation extends Model
{
    use HasFactory;
    use ModelTree;

    protected $casts = [
        'route_parameters' => 'array',
        'child_routes' => 'array',
    ];

    protected $fillable = ['title', 'path', 'is_active', 'is_visible', 'parent_id', 'weight', 'controller_action', 'route_parameters', 'child_routes'];

    // @phpstan-ignore-next-line
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    // @phpstan-ignore-next-line
    #[Scope]
    protected function inactive(Builder $query): void
    {
        $query->where('is_active', 0);
    }

    // @phpstan-ignore-next-line
    #[Scope]
    protected function visible(Builder $query): void
    {
        $query->where('is_visible', 1);
    }

    // @phpstan-ignore-next-line
    #[Scope]
    protected function hidden(Builder $query): void
    {
        $query->where('is_visible', 0);
    }
}
