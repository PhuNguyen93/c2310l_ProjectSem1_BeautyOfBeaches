<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'page_name', 'ip_address', 'visit_count', 'session_id'];

    // Visitor log có thể thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public $timestamps = true;

}
