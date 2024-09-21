<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Khu vực (area) có nhiều bãi biển
    public function beaches()
    {
        return $this->hasMany(Beach::class);
    }
}
