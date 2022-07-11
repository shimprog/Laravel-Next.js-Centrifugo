<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ["text", "user_id", "chat_id", "file"];

    protected $casts = ["file" => "array"];

    public function userInfo()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

//    public function readers()
//    {
//        return $this->belongsToMany(
//            User::class,
//            "user_message_read",
//            "chat_message_id",
//            "user_id"
//        );
//    }

    protected static function booted()
    {
        static::addGlobalScope("order", function (Builder $builder) {
            $builder->orderBy("id", "desc");
        });
    }
}
