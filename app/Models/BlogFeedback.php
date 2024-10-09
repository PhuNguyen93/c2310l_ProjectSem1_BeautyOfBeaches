<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogFeedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'blog_id', 'rating', 'comment'];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
