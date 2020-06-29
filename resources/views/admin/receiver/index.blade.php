@extends('layouts.admin');
@section('title','Alıcılar Listesı')
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('warning'))
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Hata</strong>{{session('warning')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		@endif
		<div class="card">
			<div class="card-body">
				<i class="fa fa-list" aria-hidden="true"></i> Alıcılar Listesı&#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp;
				<button id="filter" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i></button>
				<hr>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td>#</td>
							<td>Ad Soyad</td>
							<td>Passport</td>
							<td>Ülke</td>
							<td>Şehir</td>
							<td>Address</td>
							<td>Telefon</td>
							<td>Email</td>
							<td>#</td>
						</tr>
					</thead>
					<tbody>
						@foreach($receivers as $receiver)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$receiver->name}} {{$receiver->surname}}</td>
							<td>{{$receiver->passport}}</td>
							<td>{{$receiver->country}}</td>
							<td>{{$receiver->city}}</td>
							<td>{{$receiver->address}}</td>
							<td>{{$receiver->phone}}</td>
							<td>{{$receiver->email}}</td>
							
							<td>
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

@include('admin.receiver.filterModal')

@include('admin.receiver.script')

@endsection