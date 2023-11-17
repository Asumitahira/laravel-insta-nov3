<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;
    private $user;

    public function __construct(Follow $follow, User $user)
    {
        $this->follow = $follow;
        $this->user = $user;
    }

    public function store($id)
    {
        $this->follow->follower_id = Auth::user()->id;
        $this->follow->following_id = $id;
        $this->follow->save();

        return redirect()->back();
    }


    public function destroy($id)
    {
        $this->follow
            ->where('follower_id', Auth::user()->id)
            ->where('following_id', $id)
            ->delete();

        return redirect()->back();
    }
}
