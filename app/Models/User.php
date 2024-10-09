<?php

namespace App\Models;

use App\Models\Role;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Đảm bảo kế thừa từ lớp Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'country', 'img', 'birth_date', 'role_id', 'status' , 'created_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Nếu bạn có quan hệ với bảng roles, có thể thêm quan hệ ở đây
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function blogFeedbacks()
    {
        return $this->hasMany(BlogFeedback::class);
    }
}
