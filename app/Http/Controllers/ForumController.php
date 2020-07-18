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
    	$posts = Posts::all();
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

}
