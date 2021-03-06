@extends('layouts.admin')
@section('title','Kargo Status')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-hashtag" aria-hidden="true"></i> Kargo Status Ayarları &#160;&#160;&#160;
				<button id="create" class="btn btn-success ">
					<svg class="bi" width="1em" height="1em" fill="currentColor">
						<use
							xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#plus-square-fill" />
					</svg>	
				</button> &nbsp;
				
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td><b>#</b></td>
							<td><b>Ad</b></td>
							<td><b>Tür</b></td>
							<td><b>SMS</b></td>
							<td><b>SMS Mesaj</b></td>
							<td><b>Kayıt Kapatılsın mı?</b></td>
							<td><b>#</b></td>
						</tr>
					</thead>
					<tbody>
						@foreach($statuses as $status)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$status->name}}</td>
							<td>{{$status->type}}</td>
							@if($status->send_phone == 'true')
							<td>
								<span class="badge bg-success">SMS gönderilsin</span>
							</td>
							@else
							<td><span class="badge bg-danger">SMS gönderilmesin
							</span>
							</td>
							@endif
							<td>
								{{$status->sms_message ?? '' }}
							</td>
							<td>
								@if($status->public_status == 1)
								<span class="badge bg-danger">Hayır</span>
								@else
								<span class="badge bg-success">Evet</span>
								@endif
							</td>
							<td>
								<a id="edit" data-id="{{$status->id}}"
									data-sms_message="{{$status->sms_message ?? '' }}"
									data-public="{{$status->public_status}}"
									data-type="{{$status->type}}"
									data-sms="{{$status->send_phone}}"
									data-name="{{$status->name}}" href="#edit" class="btn btn-warning">
									<svg class="bi" width="1em" height="1em" fill="currentColor">
										<use
											xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#pencil-square" />
									</svg>
								</a>
								<a id="delete" data-id="{{$status->id}}"
									data-name="{{$status->name}}" href="#delete" class="btn btn-danger">
									<svg class="bi" width="1em" height="1em" fill="currentColor">
										<use
											xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#trash-fill" />
									</svg>
								</a>
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('admin.cargoStatus.deleteModal')
@include('admin.cargoStatus.createModal')
@include('admin.cargoStatus.editModal')
@include('admin.cargoStatus.filterModal')
@include('admin.cargoStatus.script')
@endsection