<?php

namespace Database\Seeders;

use App\Models\AnnouncementImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementImagesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnnouncementImages::factory(3)->create();
    }
}
