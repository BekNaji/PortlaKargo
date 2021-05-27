@extends('layouts.admin')
@section('title','Adres ayarları')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				<b class="mr-3">Adres Listesi</b>
				<a href="{{route('address.create')}}" class="btn btn-success ml-4">
					<svg class="bi" width="1em" height="1em" fill="currentColor">
						<use
							xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#plus-square-fill" />
					</svg>	
				</a>
				
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td><b>#</b></td>
							<td><b>Ad</b></td>
							<td><b>Address</b></td>
							<td><b>#</b></td>
						</tr>
					</thead>
					<tbody>
						@forelse($addresses as $item)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$item->title ?? ''}}</td>
							<td>
								{{$item->description ?? ''}}
							</td>
							<td>
								<a href="{{route('address.edit',$item->id)}}" class="btn btn-warning">
									<svg class="bi" width="1em" height="1em" fill="currentColor">
										<use
											xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#pencil-square" />
									</svg>
								</a>
								<form action="{{route('address.destroy',$item->id)}}" method="post">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger" onclick="return confirm('Emin misin ?')">
										<svg class="bi" width="1em" height="1em" fill="currentColor">
											<use
												xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#trash-fill" />
										</svg>
									</button>
								</form>								
							</td>
						</tr>							
						@empty
						<tr>
							<td colspan="4" class="text-center">Veri Yok</td>
						</tr>
							
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection