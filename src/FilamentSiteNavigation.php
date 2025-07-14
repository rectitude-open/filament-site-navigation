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

    /**
     * @return Collection<int, SiteNavigation>
     */
    public function getBreadcrumbs(?int $rootId = null, bool $includeRoot = false): Collection
    {
        $currentItem = $this->findCurrentNavigationItem();

        if (! $currentItem) {
            return new Collection;
        }

        $breadcrumbs = new Collection;
        $node = $currentItem;

        while ($node) {
            $breadcrumbs->prepend($node);
            $node = $node->parent;
        }

        if ($rootId !== null) {
            $rootIndex = $breadcrumbs->search(fn ($item) => $item->id === $rootId);
            if ($rootIndex !== false) {
                $sliceIndex = $includeRoot ? $rootIndex : $rootIndex + 1;

                return $breadcrumbs->slice($sliceIndex)->values();
            }
        }

        /** @var Collection<int, SiteNavigation> $breadcrumbs */
        return $breadcrumbs;
    }

    private function findCurrentNavigationItem(): ?SiteNavigation
    {
        $modelClass = $this->getModel();

        /** @var Collection<int, SiteNavigation> $allNavigations */
        $allNavigations = $modelClass::active()->visible()->get();

        $matchingNavigations = $allNavigations->filter(function (SiteNavigation $item) {
            if (empty($item->path) || $item->path === '#') {
                return false;
            }
            $path = ltrim($item->path, '/');

            return request()->is($path) || request()->is($path . '/*');
        });

        if ($matchingNavigations->isEmpty()) {
            return null;
        }

        $navigation = $matchingNavigations->sortByDesc(fn ($item) => strlen($item->path))->first();

        return $navigation;
    }
}
