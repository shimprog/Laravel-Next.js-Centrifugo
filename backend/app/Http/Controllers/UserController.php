<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = $request->user();
//        return $user;
//        if ($user->id !== 1) {
//            $chatsWithAdmin = $user
//                ->chats()
//                ->whereHas("users", function ($query) {
//                    $query->whereId(1);
//                })
//                ->exists();
//
//            if (!$chatsWithAdmin) {
//                $chat = Chat::create();
//                $chat->users()->save(User::find(1));
//                $chat->users()->save($user);
//            }
//        }

        return $user;
    }
}
