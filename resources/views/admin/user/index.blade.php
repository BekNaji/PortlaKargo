@extends('layouts.admin')
@section('title','Kullanıcılar Listesi')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		@if ($errors->any())
				<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
				</ul>
				</div>

				@endif
				
		<div class="card">
			<div class="card-body">
				<i class="fa fa-users" aria-hidden="true"></i> Kullanıcı Listesi &#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp;
				

				<hr>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td>#</td>
							@if(Auth::user()->role == 'root')
							<td>Company Name</td>
							@endif
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
							@if(Auth::user()->role == 'root')
							<td>{{$user->company->name ?? ''}}</td>
							@endif
							<td>{{$user->name ?? ''}}</td>
							<td>{{$user->email ?? ''}}</td>
							<td><span class="badge badge-primary">{{$user->role ?? ''}}</span></td>
							<td>
								@if($user->image !='')
								<img class="img-fluid" style="width:100px; height:100px;" src="{{asset($user->image )}}">
								@else
								<img class="img-fluid" style="width:100px; height:100px;" src="{{asset('images/avatar.png')}}">
								@endif
							</td>
							<td>
								
								
								<a href="{{route('user.edit',encrypt($user->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>

								<a id="delete" data-id="{{$user->id}}" 
									data-name="{{$user->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
								
								
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