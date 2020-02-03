<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Role;
use App\Category;
use App\Comment;
use App\CommentReply;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            $user = Auth::user();
            switch(true) {
                case $user->isAdmin():

                    $users = User::all();
                    $posts = Post::all();
                    $roles = Role::all();
                    $categories = Category::all();
                    $comments = Comment::all();
                    $replies = CommentReply::all();

                    for($i=0; $i < 12; $i++){

                        $userMonthCount[$i+1] = User::whereMonth('created_at', $i+1)->count();
                    }
                    return view('home.admin', compact(
                        'users', 'userMonthCount', 'posts', 'roles',
                        'categories', 'comments', 'replies'
                    ));
                    break;
                case $user->isModerator():

                    return view('home.moderator');
                    break;
                case $user->isMonitor():

                    return view('home.monitor');
                    break;
                default:

                    return view('home.viewer');
                    break;
            }
        }
        else {
            return view('welcome');
        }
    }
}
