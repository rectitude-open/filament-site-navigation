<?php

declare(strict_types=1);

use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

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
