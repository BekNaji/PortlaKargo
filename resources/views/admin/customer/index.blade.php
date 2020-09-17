@extends('layouts.admin')
@section('title','Gödericiler listesi')
@section('content')
<div class="row">

	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-list" aria-hidden="true"></i> <b>Göndericiler</b>&#160;&#160;&#160;
				<button id="create" class="btn btn-success "><i class="fa fa-user-plus" aria-hidden="true"></i></button> &nbsp; <button id="sendSms" type="button" class="btn btn-primary">SMS Gönder</button>
				
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td style="width:50px;">
								<input 
								type="checkbox" id="selectAll">
							</td>
							<td><b>#</b></td>
							<td><b>Ad Soyad</b></td>
							<td><b>Telefon</b></td>
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
@include('admin.customer.sendSmsModal')

@include('admin.customer.script')

@endsection