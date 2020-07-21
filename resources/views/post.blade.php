@extends('layouts.app')

@section('content')
<div class="row mx-5">
	<div class="card shadow mb-4 w-100">
		<div class="card-body">
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
		</div>
	</div>
	<div class="row mx-5 w-100">
		<div class="ml-auto mr-3">
			<div class="btn-group mb-2 ml-2">
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
		@foreach($answers as $key => $answer)
		<div class="card shadow mb-4 w-100">
			<div class="card-body">
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
			</div>
		</div>
		@endforeach
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