<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_url', 'download_count', 'beach_id'];

    public function beach()
    {
        return $this->belongsTo(Beach::class);
    }
}

