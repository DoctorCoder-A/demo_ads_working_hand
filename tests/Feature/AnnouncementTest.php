<?php

namespace Tests\Feature;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_announcement(): void
    {
        $this->withoutExceptionHandling();
        $data = [
            'name' => 'Car',
            'description' => 'Description car',
            'price' => 150,
            'images' => [
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7vHBXqL75XeQPEJdQysLmlid2s4twqWpCMA&s',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgmBkpTb20CcFglEUqY-Fvy4AM5mXb3Ivm9g&s',
                'https://autohs.ru/wp-content/uploads/2020/11/toyota-trd-3000gt-1994.jpg'
            ]
        ];

        // $this->assertEquals(0, Announcement::query()->count());
        $response = $this->post(route('announcement.store'), $data);

        $this->assertEquals(true, $response->getData()->success);
        $this->assertEquals(Announcement::query()->first()->id, $response->getData()->id);
        $this->assertEquals(1, Announcement::query()->count());
        $this->assertEquals(count($data['images']), Announcement::query()->first()->images()->count());

        $response->assertStatus(200);
    }
}
