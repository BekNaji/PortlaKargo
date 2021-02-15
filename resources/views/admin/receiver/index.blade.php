@extends('layouts.admin')
@section('title','Alıcılar Listesı')
@section('content')
<div class="row">
	<div class="col-md-12">
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
						<td>{{$item['status']->message}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
			</ul>
		</div>
		@endif
		<div class="card">
			<div class="card-body">
				<i class="fa fa-list" aria-hidden="true"></i><b> Alıcılar Listesı</b>&#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp;
				<button id="sendSms" type="button" class="btn btn-primary">SMS Gönder</button>
				<hr>
				<table id="dataTable" class="display responsive nowrap" width="100%" >
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
								<i class="fa fa-list"></i>
							</a>
								<a type="submit" 
								href="{{route('receiver.edit',encrypt($receiver->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>

								<a id="delete" data-id="{{$receiver->id}}" 
									data-name="{{$receiver->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>

								</form>
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('admin.receiver.deleteModal')

@include('admin.receiver.createModal')

@include('admin.receiver.sendSmsModal')

@include('admin.receiver.script')

@endsection