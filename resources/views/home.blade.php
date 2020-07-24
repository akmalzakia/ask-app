@extends('layouts.app')

@section('title')
{{ Auth::user()->name }}'s Profile
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card shadow mb-3">
                <div class="card-header">
                    <span>Hi, {{ Auth::user()->name }}!</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <img src="https://image.shutterstock.com/image-vector/profile-placeholder-image-gray-silhouette-260nw-1153673752.jpg" class="img-thumbnail profpic mx-auto d-block img-fluid">
                    </div>
                    <div class="row">
                        <div class="mx-auto mt-2">
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-header">
                    Question Posted
                </div>
                <div class="card-body">
                    @foreach($user_post as $key => $post)
                    <div class="row">
                        <div class="col-8 v-divider">
                            <a href="{{ route('post_view',$post->id) }}" class="text-decoration-none">{{ $post->title }}</a>
                        </div>
                        <div class="col-4 text-center m-auto">
                            <div class="btn-group">
                                <a href="{{ route('edit-post',$post->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('delete',$post->id) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    {{ $user_post->links() }}
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-header">
                    Question Answered
                </div>
                <div class="card-body">
                    @foreach($user_ans as $key => $answer)
                    <div class="row">
                        <div class="col-8 v-divider block-with-text">
                            <a href="{{ route('post_view',$answer->post_id) }}" class="text-decoration-none">{{ $answer->body }}</a>
                        </div>
                        <div class="col-4 text-center m-auto">
                            <div class="btn-group">
                                <a href="{{ route('edit-ans',[$answer->post_id,$answer->id]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('edit-ans',[$answer->post_id,$answer->id]) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    {{ $user_ans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
