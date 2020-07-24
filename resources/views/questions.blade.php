@extends('layouts.app')

@section('title')
Questions
@endsection


@if($posts->isEmpty())
@section('content')

<div class="row mx-2">
	<div class="col-md-7 mx-auto">
		<div class="card shadow mb-3">
			<div class="card-body">
				<div class="custom-container">
					<div class="custom-content">
						<div>
							Question is empty
						</div>
						<hr>
						<a href="{{ route('newpost') }}" class="btn btn-primary">Ask a Question!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
@else

@section('content')

<div class="row mx-2">
	<div class="col-md-7 mx-auto">
		<div class="row">
			<div class="mr-auto ml-3">
				<a href="{{ route('newpost') }}" class="btn btn-primary">Ask a Question</a>
			</div>
			<div class="ml-auto mr-3">
				<div class="btn-group mb-2 ml-2">
					<?php
					$search = null;
					$newest = '';
					$oldest = '';
					if(\Route::current()->getName()=='oldest'){
						$oldest = 'active';
						$newest = '';
					}
					else{
						$oldest = '';
						$newest = 'active';
					}
					if(isset($_GET['search'] )){
						$search = $_GET['search'];
						// echo "<a href='{{ route('newest',$search) }}' class='btn btn-outline-primary $newest '"
					}
					else if(Request::is('questions/oldest/*') || Request::is('questions/newest/*')){
						$search = $cari;
					}

					?>
					<a href="{{ route('newest',$search) }}" class="btn btn-outline-primary <?php echo $newest ?> ">Newest</a>
					<a href="{{ route('oldest',$search) }}" class="btn btn-outline-warning <?php echo $oldest ?> ">Oldest</a>
				</div>
			</div>
		</div>
		@foreach($posts as $key => $post)
		<div class="card shadow mb-3">
			<!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Questions</h6>
			</div> -->
			<div class="card-body">
				<div class="row mx-2">
					<div class="col-3">
						<div class="container">
							<img src="https://image.shutterstock.com/image-vector/profile-placeholder-image-gray-silhouette-260nw-1153673752.jpg" class="img-thumbnail profpic mx-auto d-block img-fluid">
						</div>
						<hr>
						<div class="mx-auto mt-1 text-center">
							{{ $post->name }}
						</div>
					</div>
					<div class="col-9">
						<h3 class="block-with-text">
							<a href="{{ route('post_view',$post->id) }}">{{ $post->title }}</a>
						</h3>
						<hr>
						<p class="block-with-text">
							{{ $post->body }}
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-6 text-center">
						<span style="font-size: 0.7em">Created on : {{ $post->created_at }}</span>
					</div>
					<div class="col-6 text-center">
						<span style="font-size: 0.7em">Last Edited : {{ $post->updated_at }}</span>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		{{ $posts->links() }}
	</div>
</div>

@endsection
@endif