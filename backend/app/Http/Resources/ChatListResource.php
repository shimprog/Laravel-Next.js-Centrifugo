<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "unread_count" => $this->unread_count,
            "users" => $this->users,
            "last_message" => new ChatMessageResource(
                $this->messages()
                    ->latest()
                    ->first()
            ),
        ];
    }
}
