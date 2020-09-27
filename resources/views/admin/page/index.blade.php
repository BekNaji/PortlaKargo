@extends('layouts.admin')
@section('title','Pages')
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
				<i class="fa fa-list" aria-hidden="true"></i> Sayfalar &#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></button> &nbsp;
				

				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>#</td>
							<td>Name</td>
							<td>Title</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						@foreach($pages as $page)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $page->name ?? '' }}</td>
							<td>{{ $page->title ?? '' }}</td>
							<td>
								<a 
								class="btn btn-warning" 
								href="{{ route('page.edit',encrypt($page->id)) }}">
								Edit
								</a>
								<a
								id="delete" 
								data-id = "{{ $page->id }}"
								data-name = "{{$page->name ?? ''}}"
								class="btn btn-danger" 
								href="#delete">
								Delete
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
@include('admin.page.deleteModal')

@include('admin.page.createModal')

@include('admin.page.script')

@endsection