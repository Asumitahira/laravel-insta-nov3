<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    //
    private $category;
    private $post;
    private $user;

    public function __construct(Category $category, Post $post, User $user){

        $this->category = $category;
        $this->post     = $post;
        $this->user     = $user;
    }

    public function index($category_id)
    {
        
        $category           = $this->category->with('posts')->findOrFail($category_id);
        $suggested_users    = $this->getSuggestedUsers();
        $home_posts         = $this->getHomePosts($category_id);


        return view('users.posts.categories.index')
            ->with('category', $category)
            ->with('suggested_users', $suggested_users)
            ->with('home_posts', $home_posts);
    }

    private function getSuggestedUsers(){

        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user) {
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }

        return array_slice($suggested_users, 0, 5);
    }

    private function getHomeposts($category_id)
    {
        $category_all_posts = $this->category->with('posts')->findOrFail($category_id);
        $home_posts = [];

        foreach ($category_all_posts->posts as $post) {
            if($post->user->isFollowed() || $post->user->id === Auth::user()->id){
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }
}
