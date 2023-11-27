<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Follow;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    # Use this method to get ALL the posts of a user
    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    //Get all the followers
    //フォローされているユーザー
    public function followers(){
        return $this->hasMany(Follow::class, 'following_id');
    }

    //フォローしているユーザー
    public function Following(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    //自分がフォローしているユーザーの情報を取得
    public function isFollowed(){   //true or false [boolean result]
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        # Auth::user()->id -----> Follower (follower_id)
        # First, get all the followers of a user (followers table) ($this->followers()).
        # Then, from that list, serching for Auth::user->id (user who is currently logged-in) in follower_id colomn
        # using the (where('follower_id', Auth::user()->id) ---- checking if that id exists (exists())
    }

    public function chat(){
        return $this->hasMany(Chat::class);
    }
}
