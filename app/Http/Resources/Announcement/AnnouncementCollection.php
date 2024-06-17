<?php

namespace App\Http\Resources\Announcement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'name' => $this->name,
            'image' => $this->images->first()?->image,
            'price' => $this->price,
        ];
        foreach ($request->fields ?? [] as $field) {
            $result[$field] = $this->$field;
        }
        return $result;
    }
}
