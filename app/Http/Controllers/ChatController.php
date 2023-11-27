<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private $chat;
    private $user;

    public function __construct(Chat $chat, User $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }

    public function index(){
        $all_users = $this->user->all()->except(Auth::user()->id);

        foreach ($all_users as $user) {
            $chats = $this->getLatestChats($user->id);
            $all_chats[$user->id] = $chats;
        }

        return view('users.chat.index')
            ->with('all_chats', $all_chats);
    }

    public function getLatestChats($id){

        $sender_id = Auth::user()->id;
        $receiver_id = $id;

        // Retrieve all of the latest chats related with login user and specific user
        $chats = $this->chat
            ->where(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $sender_id)
                      ->where('receiver_id', $receiver_id);
            })
            ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', $sender_id);
            })
            ->latest()
            ->take(1)
            ->get();

        return $chats;
    }

    private function getFollowingUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $following_users = [];

        foreach ($all_users as $user) {
            if($user->isFollowed()){
                $following_users[] = $user;
            }
        }

        return $following_users;
    }

    public function suggestUser(){
        $all_users = $this->user->all()->except(Auth::user()->id);

        return view('users.chat.suggest-user')->with('all_users', $all_users);
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        $chats = $this->getChats($id);
        $following_users = $this->getFollowingUsers();

        return view('users.chat.show')
                ->with('chats', $chats)
                ->with('user', $user)
                ->with('following_users', $following_users);
    }

    public function getChats($id){

        $sender_id = Auth::user()->id;
        $receiver_id = $id;

        // Retrieve all of the chats related with login user and specific user
        $chats = $this->chat
            ->where(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $sender_id)
                      ->where('receiver_id', $receiver_id);
            })
            ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', $sender_id);
            })
            ->get();

        return $chats;
    }

    public function store(Request $request, $id){
    // when user send the chat then run this
    # 1. validate the data
    $request->validate([
        'content'   => 'required|min:1|max:1000|'
    ]);

    # 2. Save/insert content detailes
    $this->chat->sender_id = Auth::user()->id;
    $this->chat->receiver_id = $id;
    $this->chat->content = $request->content;
    $this->chat->save();

    # 3. return to the previous page
    return redirect()->back();
    }
}
