@extends('layouts.admin')
@section('title','Genel Ayarlar')
@section('content')
<div class="row">

	<div class="col-md-8 offset-2">
		<br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-cogs" aria-hidden="true"></i> Genel Ayarlar
				<hr>
				<form action="{{route('settings.update')}}" method="POST">
					@csrf
					<div class="form-group">
						<label>Şirket adı</label>
						<input value="{{Auth::user()->company->name ?? ''}}" class="form-control" type="text" name="name" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input value="{{Auth::user()->company->email ?? ''}}" class="form-control" type="email" name="email" required>
					</div>
					<div class="form-group">
						<label>Telefon</label>
						<input value="{{Auth::user()->company->phone ?? ''}}" class="form-control" type="text" name="phone" required>
					</div>
					<div class="form-group">
						<label>Kargo Numara ilk harfı</label>
						<input value="{{Auth::user()->company->cargo_letter ?? ''}}" class="form-control" type="text" name="cargo_letter" required>
					</div>
					<div class="form-group">
						<label>Hakkinda</label>
						<textarea class="form-control" name="about">{{Auth::user()->company->about ?? ''}}</textarea>
					</div>
					<div class="form-group">
						<label>İletişim</label>
						<textarea class="form-control" name="contact">
							{{Auth::user()->company->contact ?? ''}}
						</textarea>
					</div>
					<button class="btn btn-success">Güncelle</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection