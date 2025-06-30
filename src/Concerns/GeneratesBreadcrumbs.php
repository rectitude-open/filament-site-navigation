<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Concerns;

use Illuminate\Support\Str;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;

trait GeneratesBreadcrumbs
{
    protected function generateBreadcrumbs()
    {
        $currentNav = $this->findCurrentNavigation();
        if (! $currentNav) {
            return [['title' => 'Home', 'url' => url('/')]];
        }
        $crumbs = $this->buildBreadcrumbs($currentNav);
        $lastCrumbKey = array_key_last($crumbs);
        if ($lastCrumbKey !== null && $crumbs[$lastCrumbKey]['url'] === request()->url()) {
            $crumbs[$lastCrumbKey]['url'] = null;
        }

        return $crumbs;
    }

    private function findCurrentNavigation()
    {
        $currentPath = request()->path();
        if ($currentPath === '/') {
            return null;
        }

        $navigations = config('filament-site-navigation.model', SiteNavigation::class)::active()->get();

        foreach ($navigations as $nav) {
            $navPath = trim($nav->path, '/');
            if ($navPath === $currentPath) {
                return $nav;
            }
            if (! empty($nav->child_routes)) {
                foreach ($nav->child_routes as $childPath => $action) {
                    $fullPattern = rtrim($navPath, '/') . '/' . ltrim($childPath, '/');
                    $pattern = preg_replace('/\{[^\}]+\}/', '*', $fullPattern);
                    if (Str::is(trim($pattern, '/'), $currentPath)) {
                        return $nav;
                    }
                }
            }
        }

        return null;
    }

    private function buildBreadcrumbs(SiteNavigation $nav): array
    {
        $crumbs = [];
        $currentItem = $nav;
        while ($currentItem) {
            $path = $currentItem->path;
            $url = '#';
            if (Str::startsWith($path, 'http')) {
                if (filter_var($path, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) !== false) {
                    $parsedUrl = parse_url($path);
                    if (in_array(strtolower($parsedUrl['scheme']), ['http', 'https'])) {
                        $url = $path;
                    }
                }
            } else {
                $url = url($path);
            }
            array_unshift($crumbs, [
                'title' => $currentItem->title,
                'url' => $url,
            ]);
            $currentItem = $currentItem->parent;
        }
        array_unshift($crumbs, ['title' => 'Home', 'url' => url('/')]);

        return $crumbs;
    }
}
