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

    public function post_view($id,$ans_id = null){
        $data = '';
        if(\Route::current()->getName()=='edit-post'){
            $data = Posts::find($id);
        }
        else if(\Route::current()->getName()=='edit-ans'){
            $data = Answers::find($ans_id);
        }

        $answers = Answers::where('post_id',$id)->get()->sortByDesc('created_at');

        if(\Route::current()->getName()=='oldest-ans'){
            $answers = Answers::where('post_id',$id)->get()->sortBy('created_at');
        }
        
        $post = Posts::find($id);
        return view('post',compact('post','answers','data','ans_id'));
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
    public function update(Request $request,$id){
        if(\Route::current()->getName()=='update-post'){
            Posts::where('id',$request->id)->update([
                'title' => $request->title,
                'body' => $request->body
            ]);
            return redirect()->route('post_view',$id);
        }
        else if(\Route::current()->getName()=='update-ans'){
            Answers::where('id',$request->ans_id)->update([
                'body' => $request->body
            ]);
            return redirect()->route('post_view',$id);
        }
    }
    public function delete($id,$ans_id = null){
        if(isset($ans_id)){
            $answer = Answers::find($ans_id);
            $answer->delete();
            return redirect()->route('post_view',$id);
        }
        $post = Posts::find($id);
        $post->delete();
        return redirect()->route('questions');

        
    }
}
