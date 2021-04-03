@extends('layouts.admin')
@section('title','SMS ayarlari')
@section('content')
<div class="row">
	<div class="col-md-6">
		<br>
		<div class="card">
			<div class="card-body">
				<h4>Turkiye SMS ayarlari</h4><hr>
				@if(isset($sms_title['success']) && $sms_title['succuss'])
				<div class=" text-success p-3 border border-success rounded">
				<b>Toplam SMS Adetı : </b> {{$balance['credit']}} <br>
				<b>Başlık: </b> {{$sms_title['title'] ?? 'NONE'}}
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
					<button value="tr" name="countryId" class="btn btn-success" type="submit">Güncelle</button>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<br>
		<div class="card">
			<div class="card-body">
				<h4>O'zbekistan SMS ayarlari - Limit: {{$balanceUZ ?? 'Belirsiz!'}}</h4><hr>
			
				<form action="{{route('sms.update')}}" method="POST">
					@csrf
					
					<div class="form-group">
						<label>Başlık</label>
						<input value="{{$company->sms_titleUZ}}" type="text" name="sms_titleUZ" class="form-control">
					</div>
					<div class="form-group">
						<label>API Email UZ</label>
						<input value="{{$company->api_emailUZ}}" type="text" name="api_emailUZ" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>API <a href="https://my.eskiz.uz/sms/settings" target="_blank" >bu linkten  api keyi alabilir siniz!</a></label>
						<input value="{{$company->api_keyUZ}}" type="text" name="api_keyUZ" class="form-control" required="">
					</div>

					<button value="uz" name="countryId" class="btn btn-success" type="submit">Güncelle</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection