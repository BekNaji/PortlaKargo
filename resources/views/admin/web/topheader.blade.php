@extends('layouts.admin')
@section('title','Profil Ayarları')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		@if ($errors->any())
				<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
				</ul>
				</div>

				@endif
		<div class="card">
			<div class="card-body">
				{{ __('C')}}
				<hr>
				<div class="row">
				</div>
			</div>
		</div>
	</div>
</div>

@endsection