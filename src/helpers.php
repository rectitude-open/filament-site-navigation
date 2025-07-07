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
