@extends('layouts.admin')
@section('title','Kargo Listesi')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>

		<input placeholder="Gönderici | Alıcı | Kargo Numarası" type="text" id="search" class="form-control mb-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
				<div class="col-md-9">
				<i class="fa fa-list" aria-hidden="true"></i> <span class="mr-4">Kargo Listesi </span>
				 
				@if(Permission::check('cargo-create'))
				<a href="{{route('cargo.create')}}" class="btn btn-success ">
					<svg class="bi" width="1em" height="1em" fill="currentColor">
						<use
							xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#plus-square-fill" />
					</svg>
				</a>
				&nbsp;
				@endif


				@if(Permission::check('cargo-status-change'))
				<button id="filter" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#filterModal">
					<svg class="bi" width="1em" height="1em" fill="currentColor">
						<use
							xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#filter-circle-fill" />
					</svg>
				</button>
				<button id="change" type="button" class="btn btn-warning">Status Değiştir</button>
				@endif

				@if(Permission::check('telegram-sms'))
				<button id="sendMessageTelegram" type="button" class="btn btn-primary">SMS Telegram</button>
				@endif

				@if(Permission::check('create-excel'))
				<button id="manafes" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#excelModal">Excel Hazırla</button>
				@endif
				</div>
				<div class="col-md-3">
					Kargo Adeti: <span id="cargo_count"> {{$count ?? ''}}</span>
				</div>
			</div>
				<hr>
				@if(Permission::check('cargo-index'))
				<div id="search_result" class="table-responsive">
				<table class="table" style="width:100%">
					<thead>
						<tr>
							<td style="width:50px;"><input type="checkbox" id="selectAll"></td>
							<td><b>#</b></td>
							<td><b>Baza</b></td>
							<td><b>Kategori</b></td>
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
						@if($cargos)
						@foreach($cargos as $cargo)
						<tr>
							<td><input class="cargo" type="checkbox" name="cargo[]" data-id="{{$cargo->id}}"></td>
							<td>{{($cargos ->currentpage()-1) * $cargos ->perpage() + $loop->index + 1}}</td>
							<td>
								@if ($cargo->baza == 1)
								<span class="badge bg-success">Baza-1</span>
								@elseif($cargo->baza == 2)
								<span class="badge bg-info">Baza-2</span>
								@else
								<span class="badge bg-warning">Belirsiz</span>
								@endif
							</td>
							<td>{{ $cargo->type ?? '' }}</td>
							<td>{{ $cargo->user->name ?? ''}}</td>
							<td>{{$cargo->number ?? ''}}</td>
							<td>{{$cargo->cargoStatus->name ?? ''}}</td>
							<td>@if($cargo->payment_type== 1)Göderici Öder @elseif($cargo->payment_type ==2) Alıcı Öder @endif</td>
							<td>{{$cargo->sender->name ?? ''}}</td>
							<td>{{$cargo->receiver->name ?? ''}}</td>
							<td>{{$cargo->total_kg ?? ''}}KG</td>
							<td>{{$cargo->cargo_price ?? '$0.0'}}</td>
							<td>{{date('d-m-Y H:i',strtotime($cargo->created_at))}}</td>
							<td>
								<a type="submit" target="_blank" 
									href="{{route('cargo.print',encrypt($cargo->id))}}" >
									<span class="badge bg-info">
										<svg class="bi" width="1em" height="1em" fill="currentColor">
											<use
												xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#printer-fill" />
										</svg>
									</span>
								</a>

								@if(Permission::check('cargo-show'))
								<a type="submit"
									href="{{route('cargo.show',encrypt($cargo->id))}}" >
									<span class="badge bg-warning">
										<svg class="bi" width="1em" height="1em" fill="currentColor">
											<use
												xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#pencil-square" />
										</svg>
									</span>
								</a>
								@endif

								@if(Permission::check('cargo-delete'))
								<form action="{{route('cargo.delete')}}" method="POST">
									@csrf
									<input type="hidden" name="id" value="{{$cargo->id}}">
									<button class="btn badge bg-danger" type="submit" onclick="return confirm('Eminmisin ?')">
										<svg class="bi" width="1em" height="1em" fill="currentColor">
											<use
												xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#trash-fill" />
										</svg>
									</button>
								</form>
								@endif
							</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
				{{$cargos->links()}}
				</div>
				@else
				<center><h4>Kargo listesini görmeye Yetkiniz yok!</h4></center>
				@endif
			</div>
		</div>
	</div>
</div>
@include('admin.cargo.filterModal')
@include('admin.cargo.excelModal')
@include('admin.cargo.changeStatusModal')
@include('admin.cargo.sendMessageTelegramModal')
@include('admin.cargo.script')

@endsection