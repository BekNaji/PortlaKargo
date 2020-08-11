@extends('layouts.admin');
@section('title','Kargo Status')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<i class="fa fa-hashtag" aria-hidden="true"></i> Kargo Status Ayarları &#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></button> &nbsp;
				
				<hr>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td>#</td>
							<td>Ad</td>
							<td>#</td>
						</tr>
					</thead>
					<tbody>
						@foreach($statuses as $status)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$status->name}}</td>
							<td>
								
								<a id="edit" data-id="{{$status->id}}"
									data-name="{{$status->name}}" href="#edit" class="btn btn-warning"><i class="fa fa-pen"></i>
								</a>
								<a id="delete" data-id="{{$status->id}}"
									data-name="{{$status->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i>
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