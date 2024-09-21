<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeachGallery extends Model
{
    use HasFactory;

    protected $fillable = ['beach_id', 'image_url', 'caption'];

    // Hình ảnh thuộc về một bãi biển
    public function beach()
    {
        return $this->belongsTo(Beach::class);
    }
}
