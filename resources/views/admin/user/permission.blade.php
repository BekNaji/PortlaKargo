@extends('layouts.admin')
@section('title','Kullanıcılar Role')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<a class="btn btn-primary" href="{{route('user.index')}}">Geri Git</a>	<br><br>	
		<div class="card">
			<div class="card-body">
				<i class="fa fa-list" aria-hidden="true"></i> Sayfalar&#160;&#160;&#160;

				<hr>
				<form 
				action="{{route('user.permission.update')}}" 
				method="POST" >
				@csrf
				<input type="hidden" name="user_id" value="{{$user->id}}">
					<input id="permissons_ids" type="hidden" name="ids" value="{{$user->permissions ?? ''}}">
					<button id="permission_update" class="btn btn-success">Güncelle</button>
					</form>
					<br>

				
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>#</td>
							<td><b>Sayfa Adı</b></td>
							<td><b>Izin Ver</b></td>
						</tr>
					</thead>
					<tbody>
						@foreach($pages as $page)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$page->name ?? ''}}</td>
							<td>
								<input 
								class="form-control page_id" 
								data-id="{{$page->row}}" 
								value="" type="checkbox" 
								name="page_id[]"
					@if(in_array($page->row, $user_permissions))
					checked="true" 
					@endif
								>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>

@include('admin.user.script')

@endsection