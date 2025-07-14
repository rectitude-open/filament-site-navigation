<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Collection;
use RectitudeOpen\FilamentSiteNavigation\FilamentSiteNavigation;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

if (! function_exists('site_navigations')) {
    /**
     * @return Collection<int, SiteNavigation>
     */
    function site_navigations(int $parentId = -1, bool $withHidden = false): Collection
    {
        return app(FilamentSiteNavigation::class)->getTreeByParentId($parentId, $withHidden);
    }
}

if (! function_exists('is_current_nav')) {
    function is_current_nav(SiteNavigation $item): bool
    {
        $path = ltrim($item->path, '/');
        if (request()->is($path ?: '/')) {
            return true;
        }

        if (! empty($item->child_routes)) {
            foreach (array_keys($item->child_routes) as $routePattern) {
                $fullPattern = rtrim($path, '/') . '/' . ltrim($routePattern, '/');
                $wildcardPattern = preg_replace('/\{[^\}]+\}/', '*', $fullPattern);
                if (request()->is(ltrim($wildcardPattern, '/'))) {
                    return true;
                }
            }
        }

        if ($item->children->isNotEmpty()) {
            foreach ($item->children as $child) {
                if (is_current_nav($child)) {
                    return true;
                }
            }
        }

        return false;
    }
}
