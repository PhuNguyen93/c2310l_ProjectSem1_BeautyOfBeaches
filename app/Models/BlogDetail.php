<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogDetail extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'content', 'created_at', 'updated_at'];

    // Relation with Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
