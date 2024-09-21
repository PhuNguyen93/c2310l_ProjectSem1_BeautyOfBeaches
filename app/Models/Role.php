<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // Thêm các thuộc tính khác nếu cần
    ];

    // Quan hệ với model User (nếu cần)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
