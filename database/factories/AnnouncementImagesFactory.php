<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnouncementImages>
 */
class AnnouncementImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $announcement_ids = Announcement::pluck('id')->toArray();
        return [
            'image' => fake()->unique()->imageUrl(),
            'announcement_id' => Arr::random($announcement_ids)
        ];
    }
}
