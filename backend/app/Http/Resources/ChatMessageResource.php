<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $file = $this->file;
        if (isset($file) and $file and array_key_exists("url", $file)) {
            $file["url"] = config("app.url") . Storage::url($file["url"]);
        }
        return [
            "id" => $this->id,
            "chat_id" => $this->chat_id,
            "user_id" => $this->user_id,
            "text" => $this->text,
            "file" => $file,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
