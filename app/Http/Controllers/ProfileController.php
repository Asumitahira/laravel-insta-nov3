<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')
            ->with('user', $user);
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);
        #$user[id, name,email,introduction,created_at, updated_at]
        return view('users.profile.edit')
            ->with('user', $user);
    }

    public function update(Request $request){
        # 1. Validate the data first
        $request->validate([
            'name'         => 'required|min:1|max:50',
            'email'        => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'       => 'mimes:jpeg,jpg,gif,png|max:1048',
            'introduction' => 'max:100'
        ]);

        # 2. Save new user details into the table
        $user               = $this->user->findOrFail(Auth::user()->id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;

        # 3. Check if there new image/avatar uploaded
        if ($request->avatar) {
            //convert to base64 encoding and
            //save to the table the new image/avatar if available
            $user->avatar = 'data:avatar/' . $request->avatar->extension() . ';base64,' .base64_encode(file_get_contents($request->avatar));
        }

        # 4. Execute the save() method
        $user->save();

        # 5. redirect into profile page if the update is successful
        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function showFollowers($id)
    {
        // $user = User::find($id);

        $followerIds = Follow::where('following_id', $id)->pluck('follower_id');
        $followers = User::whereIn('id', $followerIds)->get();

        $user = $this->user->findOrFail($id);

        return view('users.profile.followers')
                ->with('followers', $followers)
                ->with('user', $user);
    }

    public function showFollowing($id)
    {
        // $user = User::find($id);

        $followingIds = Follow::where('follower_id', $id)->pluck('following_id');
        $following = User::whereIn('id', $followingIds)->get();

        $user = $this->user->findOrFail($id);

        return view('users.profile.following')
                ->with('following', $following)
                ->with('user', $user);
    }

    public function editPassword(){
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('users.profile.edit-password')
            ->with('user', $user);
    }

    public function updatePassword(Request $request){
        // 1. varidate the request data
        $request->validate([
            'current_password'       => 'required',
            'new_password'           => 'required|min:8|max:20',
            'confirmation_password'  => 'required|min:8|max:20'

        ]);

        // 2. Get the logged in user's infomation
        $user = Auth::user();

        // 3.　Check if new_password and confirmation_password value are the same or not
        if ($request->new_password !== $request->confirmation_password) {
            return back()->with('error', 'new password and confirmation password are not the same.');
        }

        // 4. Update the new password
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);

            return redirect()->route('profile.editPassword')->with('success', 'パスワードの変更に成功しました。');
            // return redirect()->route('profile.editPassword')->with('success', 'Password changed successfully.');
        }

        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
}
