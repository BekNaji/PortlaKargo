@extends('layouts.admin')
@section('title','Gödericiler listesi')
@section('content')
<div class="row">
	
	<div class="col-md-12">
		<br>
		@if(session('message'))
				<div class="alert alert-primary" role="alert" style="height:200px; overflow:auto;">
					<table class="table table-striped">
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
								<td>{{$item['tel']}}</td>
								<td>{{$item['status']->status->description}}</td>
							</tr>
						@endforeach
						</tbody>
					</table>	
					</ul>
				</div>
				@endif
		
		<div class="card">
			<div class="card-body">

				<i class="fa fa-list" aria-hidden="true"></i> <b>Göndericiler</b>&#160;&#160;&#160;
				
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp; 
				
				<button id="sendSms" type="button" class="btn btn-primary">SMS Gönder</button>		
				<hr>
				<table id="dataTable" class="display responsive nowrap" style="width:100%" >
					<thead>
						<tr>
							<td style="width:50px;">
								<input 
								type="checkbox" id="selectAll">
							</td>
							<td><b>#</b></td>
							<td><b>Ad Soyad</b></td>
							<td><b>Telefon</b></td>
							<td><b>Telegram</b></td>
							<td><b>#</b></td>
						</tr>
					</thead>
					<tbody>
						@foreach($customers as $customer)
						<tr>
							<td><input class="sender" type="checkbox" name="sender[]" data-id="{{$customer->id}}"></td>
							<td>{{$loop->iteration}}</td>
							<td>{{$customer->name}}</td>
							<td>{{$customer->phone}}</td>
							@if($customer->telegram_id != '')
							<td><span class="badge badge-success">Kayitli</span></td>
							@else
							<td><span class="badge badge-danger">Kayitsiz</span></td>	
							@endif					
							<td>
								<a type="submit" 
								href="{{route('customer.show',encrypt($customer->id))}}" class="btn btn-info">
								<i class="fa fa-list"></i>
								</a>
								<a type="submit" 
								href="{{route('customer.edit',encrypt($customer->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
								

								
								<a id="delete" data-id="{{$customer->id}}" 
									data-name="{{$customer->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
								
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('admin.customer.deleteModal')

@include('admin.customer.createModal')
@include('admin.customer.sendSmsModal')

@include('admin.customer.script')

@endsection