<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'announcement_id'
    ];
}
