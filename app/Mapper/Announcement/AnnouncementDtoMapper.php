<?php

namespace App\Mapper\Announcement;

use App\Dto\AnnouncementDto;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementDtoMapper
{
    public static function fromRequest(AnnouncementRequest $request): AnnouncementDto
    {
        return new AnnouncementDto(
            $request->name,
            $request->description,
            $request->price
        );
    }
}
