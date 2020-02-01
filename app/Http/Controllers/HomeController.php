<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){
            if(Auth::user()->role){

                switch (Auth::user()->role) {
                    case 'administrator':
                        return view('home.admin');
                        break;
                    case 'viewer':
                        return view('home.viewer');
                        break;
                    case 'moderator':
                        return view('home.moderator');
                        break;
                    case 'monitor':
                        return view('home.monitor');
                        break;
                    default:
                        return view('home.viewer');
                        break;
                }
            }
            else {
                return view('home.viewer');
            }
        }
        else {
            return view('welcome');
        }
    }
}
