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

if (! function_exists('site_breadcrumbs')) {
    /**
     * @return Collection<SiteNavigation>
     */
    function site_breadcrumbs(?int $rootId = null, bool $includeRoot = false): Collection
    {
        return app(FilamentSiteNavigation::class)->getBreadcrumbs($rootId, $includeRoot);
    }
}

if (! function_exists('is_current_nav')) {
    function is_current_nav(SiteNavigation $item): bool
    {
        static $results = [];
        if (array_key_exists($item->id, $results)) {
            return $results[$item->id];
        }

        $path = ltrim($item->path, '/');
        if (request()->is($path ?: '/')) {
            return $results[$item->id] = true;
        }

        if (! empty($item->child_routes)) {
            foreach (array_keys($item->child_routes) as $routePattern) {
                $fullPattern = rtrim($path, '/') . '/' . ltrim($routePattern, '/');
                $wildcardPattern = preg_replace('/\{[^\}]+\}/', '*', $fullPattern);
                if (request()->is(ltrim($wildcardPattern, '/'))) {
                    return $results[$item->id] = true;
                }
            }
        }

        if ($item->children->isNotEmpty()) {
            foreach ($item->children as $child) {
                if (is_current_nav($child)) {
                    return $results[$item->id] = true;
                }
            }
        }

        return $results[$item->id] = false;
    }
}
