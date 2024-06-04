<?php

namespace App\Actions\Announcement;

use App\Dto\AnnouncementDto;
use App\Models\Announcement;

class StoreAction
{
    public function __construct(
        private readonly AnnouncementDto $dto,
        private readonly array $images
    ) {
    }
    public function handle(): Announcement
    {
        $announcement = new Announcement;
        $announcement->name =  $this->dto->name;
        $announcement->description =  $this->dto->description;
        $announcement->price = $this->dto->price;
        $announcement->save();
        $announcement->images()->createMany($this->getUrlImages());
        return $announcement;
    }
    private function getUrlImages(): array
    {
        $result = [];
        foreach ($this->images as $image) {
            $result[] = [
                'image' => $image,
            ];
        }
        return $result;
    }
}
