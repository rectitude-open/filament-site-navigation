<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SolutionForest\FilamentTree\Concern\ModelTree;

/**
 * @property string $title
 * @property string $path
 * @property string $url
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

    protected $appends = ['url'];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (empty($this->path)) {
                    return '';
                }

                if ($this->path === '#first-child') {
                    $firstChild = $this->children()->ordered()->first();
                    if ($firstChild) {
                        return $firstChild->url;
                    }

                    return '';
                }

                if (filter_var($this->path, FILTER_VALIDATE_URL)) {
                    return $this->path;
                }

                if ($this->path === '/') {
                    return config('app.url');
                }

                if (str_starts_with($this->path, '/')) {
                    return url($this->path);
                }

                return url('/' . ltrim($this->path, '/'));
            }
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

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
