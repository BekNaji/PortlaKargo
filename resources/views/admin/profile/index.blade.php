@extends('layouts.admin')
@section('title','Profil Ayarları')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-user" aria-hidden="true"></i> Profil Ayarları
				<hr>
				<div class="row">
					<div class="col-md-3">
						@if(Auth::user()->image != '')
						<img src="{{asset(Auth::user()->image)}}" class="img-fluid">
						@else
						<img src="{{asset('images/avatar.png')}}" class="img-fluid">
						@endif
					</div>

					<div class="col-md-9">
						
						
						<form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
							<div class="form-group">
								<label>Ad</label>
								<input class="form-control" type="text" name="name" value="{{Auth::user()->name}}" required>
							</div>

							<div class="form-group">
								<label>Email</label>
								<input value="{{Auth::user()->email}}" class="form-control" type="email" name="email" required>
							</div>

							<div class="form-group">
								<label>Parola ( Eğer boş bırakırsan şifren değişmeyecek )</label>
								<input class="form-control" type="password" name="password" >
							</div>

							<div class="form-group">
								<label>Resim</label>
								<input class="form-control" type="file" name="image">
							</div>

							<button class="btn btn-info" type="submit">Güncelle</button>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection