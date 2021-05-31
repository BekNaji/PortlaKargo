@extends('layouts.admin')
@section('title','SMS ayarlari')
@section('content')
<div class="row">
	<div class="col-md-6">
		<br>
		<div class="card">
			<div class="card-body">
				<h4>Turkiye SMS ayarlari</h4><hr>
				@if(isset($sms_title['success']) && $sms_title['success'])
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
				<h4>O'zbekistan SMS ayarlari - Limit: {{isset($balanceUZ) ? $balanceUZ : ''}}</h4><hr>
			
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
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				
				<div class="row">
					<div class="col-md-4">
						<b>Mesaj anahtarları</b><br>
						<table class="table table-bordered">
							<tr>
								<td><span class="text-info">Gönderici Tam Adı</span></td>
								<td><span class="text-info">#SENDER#</span></td>
							</tr>
		
							<tr>
								<td><span class="text-info"> Alıcı Tam Adı</span></td>
								<td><span class="text-info">#RECEIVER#</span></td>
							</tr>
		
							<tr>
								<td><span class="text-info">Kargo Numaras</span></td>
								<td><span class="text-info">#CARGO#</span></td>
							</tr>
							<tr>
								<td><span class="text-info">Pastgi qatorga o'tish</span></td>
								<td><span class="text-info">#BR#</span></td>
							</tr>
						</table>
					</div>
					<div class="col-md-8">
						<form action="{{route('sms.message.save')}}" method="POST">
							@csrf
							<div class="form-group">
								<label for="">Mesaj</label>
								<textarea class="form-control" name="message" id="" cols="30" rows="10">{{auth()->user()->company->message ?? ''}}</textarea>
							</div>
							<button class="btn btn-primary" type="submit">Kaydet</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection