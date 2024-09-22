<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'page_name', 'visit_count'];

    // Visitor log có thể thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
