<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'image_url', 'description'];

    public function details()
    {
        return $this->hasMany(BlogDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(BlogFeedback::class);
    }
}
