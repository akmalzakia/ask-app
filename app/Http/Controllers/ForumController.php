<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Posts;

class ForumController extends Controller
{
    public function addpost_view(){
    	return view('newpost');
    }
    public function questions_view(){
    	$posts = Posts::all()->sortByDesc('created_at');
    	return view('questions',compact('posts'));
    }
    public function post(Request $request){
    	$user = Auth::user()->name;
    	// return $request;
    	Posts::create([
    		'title' => $request->title,
    		'body' => $request->body,
    		'name' => $user
    	]);

    	return redirect()->route('questions');

    }
    public function search(Request $request){
        $search = $request->search;

        $posts = Posts::where('title','like','%'.$search.'%')->get()->sortByDesc('created_at');

        return view('questions',compact('posts'));

    }

    public function oldest(){
        $posts = Posts::all()->sortBy('created_at');
        return view('questions',compact('posts'));
    }

}
