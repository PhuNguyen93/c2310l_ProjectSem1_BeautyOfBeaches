<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Một role có thể thuộc nhiều người dùng
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
