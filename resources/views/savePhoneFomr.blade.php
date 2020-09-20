@extends('layouts.web')
@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-body">
				<h3>Telefon numara kayit formu</h3>
				<form action="{{route('save.phone')}}">
					<input type="hidden" name="auth" value="{{$auth}}">
					<input type="hidden" name="user_id" value="{{$user_id}}"> 
					<div class="form-group">
						<label>Telefon ( Örnek Türkiye: 5551234567  - Örnek O'zbekiston: 941234567  )</label>
						<input class="form-control" type="number" name="phone">
					</div>
					<button class="btn btn-success">Kaydet</button>

				</form>
			</div>
		</div>
	</div>
</div>
<br><br><br>





@endsection