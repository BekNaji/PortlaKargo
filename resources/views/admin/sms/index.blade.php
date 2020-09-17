@extends('layouts.admin')
@section('title','SMS ayarlari')
@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<br>
		<div class="card">
			<div class="card-body">
				<h4>SMS ayarlari</h4><hr>
				@if($balance->status->code == 200)
				<div class=" text-success p-3 border border-success rounded">
				<b>Toplam SMS Adetı : {{$balance->response->balance ?? 'NON'}}</b> <br>
				<b>Başlıklar</b>
				<ul>
					@foreach($sms_title->response->originators as $title)
					<li>{{$title}}</li>
					@endforeach
				</ul> 
				</div>
				@else
				<p class=" text-danger p-3 border border-danger rounded">API key hatalı lütfen API keyı kontrol ediniz!</p>
				@endif
				<br>


				<form action="{{route('sms.update')}}" method="POST">
					@csrf
					<div class="form-group">
						<label>Başlık</label>
						<input value="{{$company->sms_title}}" type="text" name="sms_title" class="form-control">
					</div>
					<div class="form-group">
						<label>API</label>
						<input value="{{$company->api_key}}" type="text" name="api_key" class="form-control" required="">
					</div>
					<button class="btn btn-success" type="submit">Güncelle</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection