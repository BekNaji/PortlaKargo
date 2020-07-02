@extends('layouts.admin')
@section('title','Kargo Listesi')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				
				<i class="fa fa-list" aria-hidden="true"></i> Şirket Listesi&#160;&#160;&#160;
				@csrf
				<button id="create" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></button>
				&nbsp;
				<button id="filter" type="button" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i></button>
				<button id="change" type="button" class="btn btn-warning"> Seçilen  Kayitların Durumunu Değiştir</button>
				
				
				<hr>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td style="width:50px;"><input 
								type="checkbox" id="selectAll"></td>
							<td>#</td>
							<td>Şirket Adı</td>
							<td>Email</td>
							<td>Telefon</td>
							<td>Durum</td>
							<td>Logo</td>
							<td>#</td>
							<td>#</td>
						</tr>
					</thead>
					<tbody>
						@foreach($companies as $company)
						<tr>
							<td>
							<input class="company" type="checkbox" name="company[]" data-id="{{$company->id}}">
							</td>
							<td>{{$loop->iteration}}</td>
							<td>{{$company->name ?? ''}}</td>
							<td>{{$company->email ?? ''}}</td>
							<td>{{$company->phone ?? ''}}</td>
							<td>
								@if($company->status == 0)
								Etkin değil
								@else
								Etkin
								@endif
							</td>
							<td>{{$company->logo ?? ''}}</td>
							<td>{{$company->created_at->toDateString()}}</td>
							<td>
								
								<a type="submit"
									href="{{route('company.edit',encrypt($company->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i>
								</a>
								<a id="delete" data-id="{{$company->id}}"
									data-name="{{$company->name}}"
								href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
								
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('admin.company.deleteModal')

@include('admin.company.createModal')

@include('admin.company.script')

@endsection