<?php

namespace App\Actions\Announcement;

use App\Models\Announcement;
use Illuminate\Contracts\Database\Eloquent\Builder;

class GetAction
{
    public function __construct(
        private readonly ?string $orderBy = 'created_at',
        private readonly ?string $orderType = 'desc'
    ) {
    }
    public function handle(): Builder
    {
        return Announcement::query()
            ->with('images')
            ->orderBy(
                $this->orderBy ?? 'created_at',
                $this->orderType ?? 'desc'
            );
    }
}
