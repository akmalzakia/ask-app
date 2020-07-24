@extends('layouts.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')
<div class="row mx-5">
	<div class="card shadow mb-4 col-md-7 mx-auto">
		<div class="card-body">
			@auth
			@if($post->name == Auth::user()->name && \Route::current()->getName()!='edit-post')
				<div class="row">
					<div class="dropdown ml-auto mr-3 no-arrow">
						<button class="btn btn-link dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown">
							<i class="fa fa-bars"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuButton">
							<a href="{{ route('edit-post',$post->id) }}" class="dropdown-item">Edit</a>
							<a href="{{ route('delete',$post->id) }}" class="dropdown-item">Delete</a>
						</div>
					</div>
				</div>
			@endif
			@endauth
			@if(\Route::current()->getName()=='edit-post')
			<form class="form" method="POST" action="{{ route('update-post',$post->id) }}">
				@csrf
				@method('PUT')
				<div class="row-mx-2 min-height">
					<div class="form-group">
						<label>Title</label>
						<textarea class="form-control" name="title" rows="3">{{ $data->title }}</textarea>
					</div>
				</div>
				<hr>
				<div class="row mx-2">
					<div class="col-3">
						<div class="container">
							<img src="https://image.shutterstock.com/image-vector/profile-placeholder-image-gray-silhouette-260nw-1153673752.jpg" class="img-thumbnail profpic mx-auto d-block img-fluid">
						</div>
						<hr>
						<div class="mx-auto mt-1 text-center">
							{{ $post->name }}
						</div>
						<div class="container mt-5">
							<button class="btn btn-warning w-100 mx-auto d-block" type="submit">Edit</button>
						</div>
						<div class="container mt-1">
							<button class="btn btn-danger w-100 mx-auto d-block" onclick="history.go(-1)" type="button">Back</button>
						</div>
					</div>
					<div class="col-9">
						<div class="form-group">
							<label>Body</label>
							<textarea class="form-control" name="body" rows="10">{{ $data->body }}</textarea>
						</div>
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
			</form>
			@else
			<div class="row mx-2 min-height">
				<h3 class="d-inline-block forum">
					{{ $post->title }}
				</h3>
			</div>
			<hr>
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
					<p class="forum pre-line">
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
			@endif
		</div>
	</div>
	<div class="col-md-7 mx-auto d-inline-block">
		@if(!$answers->isEmpty())
		<div class="row ml-auto">
			<div class="btn-group mb-2">
				<?php
				$newest = '';
				$oldest = '';
				if(\Route::current()->getName()=='oldest-ans'){
					$oldest = 'active';
					$newest = '';
				}
				else{
					$oldest = '';
					$newest = 'active';
				}
				?>
				<a href="{{ route('newest-ans',$post->id) }}" class="btn btn-outline-primary <?php echo $newest ?> ">Newest</a>
				<a href="{{ route('oldest-ans',$post->id) }}" class="btn btn-outline-warning <?php echo $oldest ?> ">Oldest</a>
			</div>
		</div>
		@endif
		@foreach($answers as $key => $answer)
		<div class="card shadow mb-4">
			<div class="card-body">
				@auth
				@if($answer->name == Auth::user()->name && \Route::current()->getName()!='edit-ans')
				<div class="row">
					<div class="dropdown ml-auto mr-3 no-arrow">
						<button class="btn btn-link dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown">
							<i class="fa fa-bars"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuButton">
							<a href="{{ route('edit-ans',[$post->id,$answer->id]) }}" class="dropdown-item">Edit</a>
							<a href="{{ route('delete',[$post->id,$answer->id]) }}" class="dropdown-item">Delete</a>
						</div>
					</div>
				</div>
				@endif
				@endauth
				@if(\Route::current()->getName()=='edit-ans' && $answer->id == $ans_id)
				<form class="form" method="POST" action="{{ route('update-ans',[$post->id,$answer->id]) }}">
				@csrf
				@method('PUT')
					<div class="row mx-2">
						<div class="col-3">
							<div class="container">
								<img src="https://image.shutterstock.com/image-vector/profile-placeholder-image-gray-silhouette-260nw-1153673752.jpg" class="img-thumbnail profpic mx-auto d-block img-fluid">
							</div>
							<hr>
							<div class="mx-auto mt-1 text-center">
								{{ $answer->name }}
							</div>
							<div class="container mt-5">
								<button class="btn btn-warning w-100 mx-auto d-block" type="submit">Edit</button>
								
							</div>
							<div class="container mt-1">
								<button class="btn btn-danger w-100 mx-auto d-block" onclick="history.go(-1)" type="button">Back</button>
							</div>
						</div>
						<div class="col-9">
							<div class="form-group">
								<label>Body</label>
									<textarea class="form-control" name="body" rows="10">{{ $answer->body }}</textarea>
							</div>
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
				</form>
				@else
				<div class="row mx-2">
					<div class="col-3">
						<div class="container">
							<img src="https://image.shutterstock.com/image-vector/profile-placeholder-image-gray-silhouette-260nw-1153673752.jpg" class="img-thumbnail profpic mx-auto d-block img-fluid">
						</div>

						<div class="mx-auto mt-1 text-center">
							{{ $answer->name }}
						</div>
					</div>
					<div class="col-9">
						<p class="forum pre-line">
							{{ $answer->body }}
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-6 text-center">
						<span style="font-size: 0.7em">Created on : {{ $answer->created_at }}</span>
					</div>
					<div class="col-6 text-center">
						<span style="font-size: 0.7em">Last Edited : {{ $answer->updated_at }}</span>
					</div>
				</div>
				@endif
			</div>
		</div>
		@endforeach
		{{ $answers->links() }}
		<div class="card shadow mb-4 w-100">
			<div class="card-header">
				<span>Your Answer</span>
			</div>
			<div class="card-body">
				<form action="{{ route('answer',$post->id) }}" method="POST" class="form">
					@csrf
					<div class="form-group">
						<textarea id="body" name="body" class="form-control" required></textarea>
					</div>
					<button class="btn btn-primary" type="submit">Post Answer</button>
				</form>
			</div>
		</div>
	</div>
	
</div>
@endsection