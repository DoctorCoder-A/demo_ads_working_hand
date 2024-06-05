<?php

namespace Tests\Feature;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    //get announcement
    public function test_paginate_getting_announcement_list()
    {
        Announcement::factory(20)->create();
        $response = $this->get(route('announcement.index'));
        $this->assertCount(10, $response->getData()->data);
    }
    public function test_order_by_price_desc_getting_announcement_list()
    {
        Announcement::factory(20)->create();
        $response = $this->get(route('announcement.index', [
            'orderBy' => 'price',
            'orderType' => 'desc'
        ]));
        $firstItem = reset($response->getData()->data);
        $maxPrice = Announcement::query()->max('price');
        $this->assertEquals($maxPrice, $firstItem->price);
    }
    public function test_order_by_price_asc_getting_announcement_list()
    {
        Announcement::factory(20)->create();
        $response = $this->get(route('announcement.index', [
            'orderBy' => 'price',
            'orderType' => 'asc'
        ]));
        $firstItem = reset($response->getData()->data);
        $minPrice = Announcement::query()->min('price');
        $this->assertEquals($minPrice, $firstItem->price);
    }
    public function test_order_by_created_at_desc_getting_announcement_list()
    {
        Announcement::factory(5)->create();
        Announcement::factory(5)->create();
        Announcement::factory(5)->create();
        $response = $this->get(route('announcement.index', [
            'orderBy' => 'created_at',
            'orderType' => 'desc'
        ]));
        $firstItem = reset($response->getData()->data);
        $latestItem = Announcement::query()->latest()->first();
        $this->assertEquals($latestItem->name, $firstItem->name);
    }
    public function test_order_by_created_at_asc_getting_announcement_list()
    {
        Announcement::factory(5)->create();
        Announcement::factory(5)->create();
        Announcement::factory(5)->create();
        $response = $this->get(route('announcement.index', [
            'orderBy' => 'created_at',
            'orderType' => 'asc'
        ]));
        $firstItem = reset($response->getData()->data);
        $latestItem = Announcement::query()->orderBy('created_at', 'asc')->first();
        $this->assertEquals($latestItem->name, $firstItem->name);
    }
    //show announcement
    public function test_show_getting_announcement_list()
    {
        Announcement::factory(20)->create();
        $announcement = Announcement::first();
        $fields = ['id','created_at'];
        $response = $this->post(route('announcement.show', [
            'fields' => $fields,
            'announcement' => $announcement->id
        ]));
        $item = $response->getData()->data;
        foreach ($fields as $key => $field) {
            $this->assertEquals(1, (bool)$item?->$field);
        }

    }
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
        $this->assertCount(Announcement::query()->first()->images()->count(), $data['images']);

        $response->assertStatus(200);
    }
}
