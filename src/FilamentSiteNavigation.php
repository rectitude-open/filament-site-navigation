<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation;

use Illuminate\Database\Eloquent\Collection;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

class FilamentSiteNavigation
{
    /**
     * @return class-string<SiteNavigation>
     */
    public function getModel(): string
    {
        return config('filament-site-navigation.model', SiteNavigation::class);
    }

    /**
     * @return Collection<int, SiteNavigation>
     */
    public function getTreeByParentId(int $parentId = -1, bool $withHidden = false): Collection
    {
        $query = $this->getModel()::active()->where('parent_id', $parentId);

        $query->with(['children' => function ($query) use ($withHidden) {
            if (! $withHidden) {
                $query->active()->visible();
            }
        }]);

        $navigations = $query->ordered()->get();

        /** @var Collection<int, SiteNavigation> $navigations */
        return $navigations;
    }
}
