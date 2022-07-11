<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static find(int $int)
 * @method static findOrFail(mixed $user_id)
 * @method static forceCreate(array $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ["info"];

    protected $casts = [
        "info" => "array",
    ];

    public function chats()
    {
        return $this->belongsToMany(Chat::class)->withTimestamps();
    }
}
