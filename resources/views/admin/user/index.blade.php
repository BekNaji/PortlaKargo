@extends('layouts.admin')
@section('title','Kullanıcılar Listesi')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<i class="fa fa-users" aria-hidden="true"></i> Kullanıcı Listesi &#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp;
				<button id="filter" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i></button>
				<hr>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td>#</td>
							<td>Ad</td>
							<td>Email</td>
							<td>Yetkı</td>
							<td>Resim</td>
							<td>#</td>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td><span class="badge badge-primary">{{$user->role}}</span></td>
							<td>
								@if($user->image !='')
								<img class="img-fluid" style="width:100px; height:100px;" src="{{asset($user->image)}}">
								@else
								<img class="img-fluid" style="width:100px; height:100px;" src="{{asset('images/avatar.png')}}">
								@endif
							</td>
							<td>
								<form action="{{route('user.edit')}}" method="POST">
									@csrf
									<input type="hidden" name="id" value="{{$user->id}}">
								<button type="submit" href="{{route('user.edit')}}" class="btn btn-warning"><i class="fa fa-edit"></i></button>

								<a id="delete" data-id="{{$user->id}}" 
									data-name="{{$user->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
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
@include('admin.user.deleteModal')

@include('admin.user.createModal')

@include('admin.user.filterModal')

@include('admin.user.script')

@endsection