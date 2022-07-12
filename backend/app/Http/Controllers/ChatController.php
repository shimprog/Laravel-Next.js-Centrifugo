<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Http\Requests\UpdateChatRequest;
use App\Http\Resources\ChatListResource;
use App\Http\Resources\ChatMessageResource;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }


    public function newChat(Request $request)
    {
        $users_list = explode(",", $request->users);

        $chat = Chat::create([
            "id" => $request->chat_id,
            "title" => $request->title,
        ]);

        foreach ($users_list as $user) {
            $userOne = User::find($user);
            if (!!$userOne) {
                $chat->users()->save($userOne);
            }
        }
        $chat->save();

        return $chat;
    }

    public function update(UpdateChatRequest $request, Chat $chat)
    {
        $chat->update($request->validated());
        return $chat;
    }

    public function store(Request $request)
    {
        $msg = ChatMessage::create([
            "chat_id" => 1,
            "user_id" => $request->user()->id,
            "text" => $request->text,
        ]);
        $this->centrifugo->publish('channel', ['value' => $request->text]);
        return $msg;
//
//        if (isset($request->file)) {
//            $download = $request->file->storeAs(
//                "public/chat/" . $chat->id,
//                $request->file->hashName()
//            );
//            $msg->file = [
//                "url" => $download,
//                "mimes" => $request->file->extension(),
//            ];
//            $msg->save();
//        }
//
//        broadcast(new Message($msg));
//        return new ChatMessageResource($msg);
    }

    public function newUser(Request $request)
    {
        $chat = Chat::findOrFail($request->chat_id);
        $user = User::findOrFail($request->user_id);

        if ($chat->users->contains($user)) {
            return response()->json(["message" => "Already exists."], 400);
        }

        $chat->users()->save($user);

        return $chat;
    }

    public function removeUser(Request $request)
    {
        $chat = Chat::findOrFail($request->chat_id);
        $user = User::findOrFail($request->user_id);

        if (!$chat->users->contains($user)) {
            return response()->json(["message" => "Not in chat."], 400);
        }

        $chat->users()->detach($user);

        return $chat;
    }

    public function chatInfo(Request $request, Chat $chat)
    {
        $pageSize = $request->get("page_size", 100);

        $chat->markAsRead();

        return ChatMessageResource::collection(
            $chat->messages()->paginate($pageSize)
        );
    }

    /**
     * Return chat list
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return ChatListResource::collection($request->user()->chats);
    }

    public function register(Request $request)
    {

//        // Send message into channel
//        $centrifugo->publish('channel', ['value' => 'Hello world']);
//
        // Generate connection token
        $token = $this->centrifugo->generateConnectionToken((string)Auth::id(), 0, [
            'info' => Auth::user()->info,
        ]);
        return $token;
//
//        // Generate private channel token
//        $apiSign = $centrifugo->generatePrivateChannelToken((string)Auth::id(), 'channel', time() + 5 * 60, [
//            'name' => Auth::user()->info,
//        ]);
//        return $apiSign;
//
//        //Get a list of currently active channels.
//        $centrifugo->channels();
//
//        //Get channel presence information (all clients currently subscribed on this channel).
//        $centrifugo->presence('news');

    }

}
