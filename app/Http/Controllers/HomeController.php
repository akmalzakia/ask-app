<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Posts;
use App\Answers;

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
        $user_name = Auth::user()->name;
        $user_post = Posts::where('name',$user_name)->orderByRaw('created_at DESC')->paginate(5);
        $user_ans = Answers::where('name',$user_name)->orderByRaw('created_at DESC')->paginate(5);


        return view('home',compact('user_post','user_ans'));
    }
}
