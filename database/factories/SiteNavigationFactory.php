<?php

declare(strict_types=1);

namespace RectitudeOpen\FilamentSiteNavigation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation>
 */
class SiteNavigationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'parent_id' => $this->faker->numberBetween(-1, 10),
            'weight' => $this->faker->numberBetween(0, 100),
            'url' => $this->faker->url,
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
