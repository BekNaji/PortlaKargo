@extends('layouts.admin')
@section('title','Şehir ayarları')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				<b class="mr-3">Şehir Listesi</b>
				<a href="{{route('city.create')}}" class="btn btn-success ml-4">
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
							<td><b>Şehir</b></td>
							<td><b>Baza</b></td>
							<td><b>#</b></td>
						</tr>
					</thead>
					<tbody>
						@foreach($cities as $city)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$city->name}}</td>
							<td>
								@if ($city->type == 1)
									<span class="badge bg-success">
										Baza-1
									</span>
								@else
								<span class="badge bg-info">
									Baza-2
								</span>
								@endif
							</td>
							<td>
								<a href="{{route('city.edit',$city->id)}}" class="btn btn-warning">
									<svg class="bi" width="1em" height="1em" fill="currentColor">
										<use
											xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#pencil-square" />
									</svg>
								</a>
								<form action="{{route('city.destroy',$city->id)}}" method="post">
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
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection