<?php

namespace App\Http\Controllers;

use App\Actions\Announcement\GetAction;
use App\Actions\Announcement\StoreAction;
use App\Http\Requests\Announcement\IndexRequest;
use App\Http\Requests\Announcement\ShowRequest;
use App\Http\Requests\AnnouncementRequest;
use App\Http\Resources\Announcement\ShowResource;
use App\Http\Resources\Announcement\GetResource;
use App\Mapper\Announcement\AnnouncementDtoMapper;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = (new GetAction($request->orderBy, $request->orderType))
            ->handle();
        return GetResource::collection(
            $data->paginate(10, ['*'], 'page', $request->page ?? 1)
        );
    }
    public function show(Announcement $announcement, ShowRequest $request)
    {
        return new ShowResource($announcement);
    }
    public function store(AnnouncementRequest $request)
    {
        $action = new StoreAction(AnnouncementDtoMapper::fromRequest($request), $request->images);
        return response()->json([
            'success' => true,
            'id' => $action->handle()->id,
        ]);
    }
}
