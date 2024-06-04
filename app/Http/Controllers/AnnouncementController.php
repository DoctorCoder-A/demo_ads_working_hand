<?php

namespace App\Http\Controllers;

use App\Actions\Announcement\StoreAction;
use App\Http\Requests\AnnouncementRequest;
use App\Mapper\Announcement\AnnouncementDtoMapper;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function store(AnnouncementRequest $request)
    {
        $action = new StoreAction(AnnouncementDtoMapper::fromRequest($request), $request->images);
        return response()->json([
            'success' => true,
            'id' => $action->handle()->id,
        ]);
    }
}
