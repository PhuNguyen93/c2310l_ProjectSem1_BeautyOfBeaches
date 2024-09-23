<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beach extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'area_id', 'image_url'];

    // Bãi biển thuộc về một khu vực (area)
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // Bãi biển có nhiều feedback
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Bãi biển có thể có nhiều hình ảnh trong gallery
    public function gallery()
    {
        return $this->hasMany(BeachGallery::class);
    }
}
