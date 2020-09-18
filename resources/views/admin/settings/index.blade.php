@extends('layouts.admin')
@section('title','Genel Ayarlar')
@section('content')
<div class="row">

	<div class="col-md-8 offset-md-2">
		<br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-cogs" aria-hidden="true"></i> Genel Ayarlar
				<hr>
				
				@if(session('message'))
				<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Bildirim!</strong>{{session('message')}}
				</div>
				@endif
				<center style="border:1px solid;">
					@if(Auth::user()->company->logo)
					<img style="width:auto"; height="100px" 
					src="{{asset(Auth::user()->company->logo ?? '')}}">
					@else
					<img style="width:auto"; height="100px" src="https://seeklogo.com/images/W/w-letter-company-logo-3102E4E551-seeklogo.com.png">
					@endif


				</center><br>
				<form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Logo</label>
						<input  class="form-control" type="file" name="logo">
					</div>
					<div class="form-group">
						<label>Şirket adı</label>
						<input value="{{Auth::user()->company->name ?? ''}}" class="form-control" type="text" name="name" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input value="{{Auth::user()->company->email ?? ''}}" class="form-control" type="email" name="email" required>
					</div>
					<div class="form-group">
						<label>Instagram</label>
						<input value="{{Auth::user()->company->instagram ?? ''}}" class="form-control" type="text" name="instagram" required>
					</div>
					<div class="form-group">
						<label>Telefon 1</label>
						<input value="{{Auth::user()->company->phone ?? ''}}" class="form-control" type="text" name="phone" required>
					</div>
					<div class="form-group">
						<label>Telefon 2</label>
						<input value="{{Auth::user()->company->second_phone ?? ''}}" class="form-control" type="text" name="second_phone" >
					</div>
					<div class="form-group">
						<label>Kargo Numara  </label>
						<input value="{{Auth::user()->company->cargo_row ?? ''}}" class="form-control" type="text" name="cargo_row" required>
					</div>
					<div class="form-group">
						<label>Kargo Numara ilk harfı</label>
						<input value="{{Auth::user()->company->cargo_letter ?? ''}}" class="form-control" type="text" name="cargo_letter" required>
					</div>

					
					<div class="form-group">
						<label>Şirket adresı</label>
						<textarea class="form-control" name="address">{{Auth::user()->company->address ?? ''}}</textarea>
					</div>
					<div class="form-group">
						<label>Yurtdışı Adres</label>
						<textarea class="form-control" name="other_address">{{Auth::user()->company->other_address ?? ''}}</textarea>
					</div>

					

					<button class="btn btn-success">Güncelle</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>

CKEDITOR.replace( 'editor1' );
</script>
@endsection
