@extends('layouts.admin')
@section('title','Kargo Status Düzenle')
@section('content')
<div class="row">
	<div class="col-md-12">
		
		<a class="btn btn-primary " href="{{route('user.index')}}">Geri git</a> 
		<br><br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-user" aria-hidden="true"></i> Kullanıcı Ayarları 
				<hr>
				<div class="row">
					<div class="col-md-3">
						@if($user->image != '')
						<img src="{{asset($user->image)}}" class="img-fluid">
						@else
						<img src="{{asset('images/avatar.png')}}" class="img-fluid">
						@endif
					</div>

					<div class="col-md-9">
						
						
						<form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="id" value="{{$user->id}}">
							<div class="form-group">
								<label>Ad</label>
								<input class="form-control" type="text" name="name" value="{{$user->name}}" required>
							</div>

							<div class="form-group">
								<label>Email</label>
								<input value="{{$user->email}}" class="form-control" type="email" name="email" required>
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