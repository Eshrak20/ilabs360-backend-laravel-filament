<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryVideo extends Model
{
    protected $fillable = ['title', 'description', 'place', 'video_id'];
}
