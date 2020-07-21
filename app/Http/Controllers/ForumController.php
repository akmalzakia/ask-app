<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Posts;
use App\Answers;

class ForumController extends Controller
{
    public function index(){
        return view('welcome');
    }


    public function addpost_view(){
    	return view('newpost');
    }
    public function questions_view(Request $request,$search = null){
        $posts = Posts::all();
        if(isset($request->search)){

            $cari = $request->search;

            if(\Route::current()->getName()=='oldest'){
                $posts = Posts::where('title','like','%'.$cari.'%')->get()->sortBy('created_at');
            }
            else{
                $posts = Posts::where('title','like','%'.$cari.'%')->get()->sortByDesc('created_at');
            }


            return view('questions',compact('posts','cari'));

        }


        if(\Route::current()->getName()=='oldest'){
            $posts = Posts::all()->sortBy('created_at');
        }
        else{
            $posts = Posts::all()->sortByDesc('created_at');
        }

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

    public function post_view($id){

        $answers = Answers::where('post_id',$id)->get()->sortByDesc('created_at');

        if(\Route::current()->getName()=='oldest-ans'){
            $answers = Answers::where('post_id',$id)->get()->sortBy('created_at');
        }
        
        $post = Posts::find($id);
        return view('post',compact('post','answers'));
    }

    public function answer(Request $request, $id){
        $user = Auth::user()->name;
        Answers::create([
            'body' => $request->body,
            'name' => $user,
            'post_id' => $id
        ]);

        return redirect()->route('post_view',$id);
    }
}
