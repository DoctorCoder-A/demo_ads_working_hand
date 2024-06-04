<?php

namespace App\Dto;

class AnnouncementDto
{
    public function __construct(
        public string $name,
        public string $description,
        public int $price,
    )
    {}
}
