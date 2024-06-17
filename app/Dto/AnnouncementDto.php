<?php

namespace App\Dto;

use App\Http\Requests\AnnouncementRequest;

class AnnouncementDto
{
    public function __construct(
        public string $name,
        public string $description,
        public int $price,
    )
    {}

    public static function fromRequest(AnnouncementRequest $request): self
    {
        return new AnnouncementDto(
            $request->name,
            $request->description,
            $request->price
        );
    }
}
