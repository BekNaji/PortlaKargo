@extends('layouts.admin')
@section('title','Kargo Listesi')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				@php
				
				@endphp
				<i class="fa fa-list" aria-hidden="true"></i> <span class="mr-4">Kargo Listesi </span>
				
				@if(Permission::check('cargo-create'))
				<a href="{{route('cargo.create')}}" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></a>
				&nbsp;
				@endif


				@if(Permission::check('cargo-status-change'))
				<button id="filter" type="button" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i></button>
				<button id="change" type="button" class="btn btn-warning">Status Değiştir</button>
				@endif

				@if(Permission::check('telegram-sms'))
				<button id="sendMessageTelegram" type="button" class="btn btn-primary">SMS Telegram</button>
				@endif

				@if(Permission::check('create-excel'))
				<button id="manafes" type="button" class="btn btn-info">Excel Hazırla</button>
				@endif
				
				<hr>
				@if(Permission::check('cargo-index'))
				<table id="dataTable" class="display responsive table-responsive" style="width:100%">
					<thead>
						<tr>
							<td style="width:50px;"><input 
								type="checkbox" id="selectAll"></td>
							<td><b>#</b></td>
							<td><b>Kullanıcı</b></td>
							<td><b>Takip No</b></td>
							<td><b>Durum</b></td>
							<td><b>Ödeme</b></td>
							<td><b>Göderici</b></td>
							<td><b>Alıcı</b></td>
							<td><b>Toplam Kg</b></td>
							<td><b>Kargo Ücreti</b></td>
							<td><b>Oluşturma Tarih</b></td>
							<td><b>#</b></td>
						</tr>
					</thead>
					<tbody>
						@isset($data)
						@foreach($data['cargos'] as $cargo)
						<tr>
							<td>
							<input class="cargo" type="checkbox" name="cargo[]" data-id="{{$cargo['id']}}">
							</td>
							<td>{{$loop->iteration}}</td>
							<td>{{ $cargo['user'] ?? ''}}</td>
							<td>{{$cargo['number'] ?? ''}}</td>
							<td>{{$cargo['status'] ?? ''}}</td>
							<td>
								@if($cargo['payment_type'] == 1)
								Göderici Öder
								@elseif($cargo['payment_type'] ==2)
								Alıcı Öder
								@endif
							</td>
							<td>{{$cargo['sender'] ?? ''}} {{$cargo->sender->surname ?? ''}}</td>
							<td>{{$cargo['receiver'] ?? ''}} {{$cargo->receiver->surname ?? ''}}</td>
							<td>{{$cargo['total_kg'] ?? ''}}KG</td>
							<td>{{$cargo['cargo_price'] ?? '$0.0'}}</td>
							<td>{{$cargo['created_at']->toDateString()}}</td>
							<td>

								<a type="submit" target="_blank" 
									href="{{route('cargo.print',encrypt($cargo['id']))}}" >
									<span class="badge badge-info">
									<i class="fa fa-print"></i>
									</span>
								</a>

								@if(Permission::check('cargo-show'))
								<a type="submit"
									href="{{route('cargo.show',encrypt($cargo['id']))}}" >
									<span class="badge badge-warning">
									<i class="fa fa-edit"></i>
									</span>
								</a>
								@endif

								@if(Permission::check('cargo-delete'))
								<a id="delete" data-id="{{$cargo['id']}}"
									data-name="{{$cargo['number']}}"
								href="#delete">
								<span class="badge badge-danger">
								<i class="fa fa-trash-alt "></i>
								</span>
								</a>
								@endif
								
								
							</td>
						</tr>
						@endforeach
						@endisset
					</tbody>
				</table>
				@else
				<center><h4>Kargo listesini görmeye Yetkiniz yok!</h4></center>
				@endif
			</div>
		</div>
	</div>
</div>
@include('admin.cargo.deleteModal')
@include('admin.cargo.createModal')
@include('admin.cargo.filterModal')
@include('admin.cargo.excelModal')
@include('admin.cargo.changeStatusModal')
@include('admin.cargo.sendMessageTelegramModal')
@include('admin.cargo.script')

@endsection