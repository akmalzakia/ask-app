@extends('layouts.app')
@section('content')

<div class="row mx-2">
	<div class="col-xl-8 col-lg-7">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Questions</h6>
			</div>
			<div class="card-body">
				@foreach($posts as $key => $post)
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
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-5">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
			<div class="card-body">
			</div>
		</div>
	</div>
</div>

@endsection