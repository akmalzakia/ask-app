@extends('layouts.app')
@section('content')

<div class="row mx-2">
	<div class="col-xl-4 col-lg-5">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
			<div class="card-body">
				<div class="row">
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-8 col-lg-7">
		<div class="row">
			<div class="mr-auto ml-3">
				<a href="{{ route('newpost') }}" class="btn btn-primary">Ask a Question</a>
			</div>
			<div class="ml-auto mr-3">
				<div class="btn-group mb-2 ml-2">
					<?php
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
					?>
					<a href="{{ route('newest') }}" class="btn btn-outline-primary <?php echo $newest ?> ">Newest</a>
					<a href="{{ route('oldest') }}" class="btn btn-outline-warning <?php echo $oldest ?> ">Oldest</a>
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
							{{ $post->title }}
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
	</div>
</div>

@endsection