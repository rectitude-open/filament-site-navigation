<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

/**
 * @property string $title
 * @property string $path
 * @property int $is_active
 * @property int $parent_id
 * @property int $weight
 */
class SiteNavigation extends Model
{
    use HasFactory;
    use ModelTree;

    protected $fillable = ['title', 'path', 'is_active', 'parent_id', 'weight'];
}
