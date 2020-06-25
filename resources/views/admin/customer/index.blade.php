@extends('layouts.admin');

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<i class="fa fa-list" aria-hidden="true"></i> Göndericiler&#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp;
				<button id="filter" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i></button>
				<hr>
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td>#</td>
							<td>Ad Soyad</td>
							<td>Email</td>
							<td>Telefon</td>
							<td>Ülke</td>
							<td>Şehir</td>
							<td>Address</td>

							<td>Passport</td>
							<td>Kimlik</td>
							<td>#</td>
						</tr>
					</thead>
					<tbody>
						@foreach($customers as $customer)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$customer->name}} {{$customer->surname}}</td>
							<td>{{$customer->email}}</td>
							<td>{{$customer->phone}}</td>
							<td>{{$customer->country}}</td>
							<td>{{$customer->city}}</td>
							<td>{{$customer->address}}</td>
							<td>{{$customer->passport}}</td>
							<td>{{$customer->identity}}</td>
							
							<td>
								
								<a type="submit" 
								href="{{route('customer.edit',encrypt($customer->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>

								<a id="delete" data-id="{{$customer->id}}" 
									data-name="{{$customer->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>

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
@include('admin.customer.deleteModal')

@include('admin.customer.createModal')

@include('admin.customer.filterModal')

@include('admin.customer.script')

@endsection