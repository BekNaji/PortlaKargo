@extends('layouts.admin')
@section('title','Alıcılar Listesı')
@section('content')
<div class="row">
	<div class="col-md-12">
		<form action="{{route('receiver.search')}}" class="mt-4">
			<div class="row">
				<div class="col-md-10">
					<input value="{{app('request')->input('key')}}" type="text" name="key" class="form-control" placeholder="Ad Soyad | Passport | Telefon ">
					@error('key')
					<span class="text-danger">{{$message}}</span>
					@enderror
				</div>
				<div class="col-md-2">
					<button class="btn btn-primary" type="submit">Ara</button>		
					<a class="btn btn-info" href="{{route('customer.index')}}">Temizle</a>	
				</div>
			</div>	
		</form>
		<br>
		@if(session('warning'))
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Hata</strong>{{session('warning')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		@endif
		@if(session('message'))
		<div class="alert alert-primary" role="alert" style="height:200px; overflow:auto;">
			@php
				print_r(session('message'))
			@endphp
			{{-- <table class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Numara</td>
						<td>Status</td>
					</tr>
				</thead>
				<tbody>
					@foreach (session('message') as $item)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>@php
							print
						@endphp</td>
					</tr>
					@endforeach
				</tbody>
			</table>	 --}}
			
		</div>
		@endif
		<div class="card">
			<div class="card-body">
				<i class="fa fa-list" aria-hidden="true"></i><b> Alıcılar Listesı</b>&#160;&#160;&#160;
				<button id="create" class="btn btn-success ">
					<svg class="bi" width="1em" height="1em" fill="currentColor">
						<use
							xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#plus-square-fill" />
					</svg>	
				</button> &nbsp;
				<button id="sendSms" type="button" class="btn btn-primary">SMS Gönder</button>
				<hr>
				<table class="table table-bordered" width="100%" >
					<thead>
						<tr>
							<td style="width:50px;">
								<input 
								type="checkbox" id="selectAll">
							</td>
							<td><b>#</b></td>
							<td><b>Ad Soyad</b></td>
							<td><b>Passport</b></td>
							<td><b>Telefon</b></td>
							<td><b>Telegram</b></td>
							<td><b>Address</b></td>
							<td><b>#</b></td>
						</tr>
					</thead>
					<tbody>
						@foreach($receivers as $receiver)
						<tr>
							<td><input class="receiver" type="checkbox" name="receiver[]" data-id="{{$receiver->id}}"></td>

							<td>{{$loop->iteration}}</td>
							<td>{{$receiver->name}}</td>
							<td>{{$receiver->passport}}</td>
							<td>{{$receiver->phone}}</td>
							@if($receiver->telegram_id != '')
							<td><span class="badge badge-success">Kayitli</span></td>
							@else
							<td><span class="badge badge-danger">Kayitsiz</span></td>	
							@endif					
							
							<td>{{$receiver->address}}</td>
							<td>
							<a type="submit" 
								href="{{route('receiver.show',encrypt($receiver->id))}}" class="btn btn-info">
								<svg class="bi" width="1em" height="1em" fill="currentColor">
									<use
										xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#eye" />
								</svg>
							</a>
								<a type="submit" 
								href="{{route('receiver.edit',encrypt($receiver->id))}}" class="btn btn-warning">
								<svg class="bi" width="1em" height="1em" fill="currentColor">
									<use
										xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#pencil-square" />
								</svg>
							</a>

								<a id="delete" data-id="{{$receiver->id}}" 
									data-name="{{$receiver->name}}" href="#delete" class="btn btn-danger">
									<svg class="bi" width="1em" height="1em" fill="currentColor">
										<use
											xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#trash-fill" />
									</svg>
								</a>

								</form>
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{$receivers->links()}}
			</div>
		</div>
	</div>
</div>
@include('admin.receiver.deleteModal')

@include('admin.receiver.createModal')

@include('admin.receiver.sendSmsModal')

@include('admin.receiver.script')

@endsection