<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Models;

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
 * @property int $parent_id
 * @property int $weight
 */
class SiteNavigation extends Model
{
    use HasFactory;
    use ModelTree;

    protected $casts = [
        'route_parameters' => 'array',
    ];

    protected $fillable = ['title', 'path', 'is_active', 'parent_id', 'weight', 'controller_action', 'route_parameters', 'child_route_pattern', 'child_controller_action'];
}
