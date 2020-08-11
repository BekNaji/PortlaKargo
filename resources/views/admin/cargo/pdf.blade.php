<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{Auth::user()->company->name ?? ''}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>
<body>
	<div class="container" id="pdf">
		<br><br>
		<div class="row">
			<div class="col-md-12">

				<div class="card">
					<div class="card-body">

						<div class="row">
							<div class="col-md-4">
								<h3>{{$company->name ?? ''}}</h3>
							</div>

							<div class="col-md-4">
								<center><img src="{{url($barcode)}}"></center>
							</div>

							<div class="col-md-4">
								<h3><span class="float-right ">{{$cargo->number ?? ''}}</span></h3>
							</div>
						</div>
					</div>
				</div>
				<br>
			</div>
			<div class="col-md-5">
				<div class="row">
					{{-- Sender  --}}
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								{{$company->address ?? ''}}
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<i class="fa fa-hashtag" aria-hidden="true"></i> SENDER / ОТПРАВИТЕЛЬ
								<hr>
								<div class="row">
			
									@if($cargo->sender_id != '')
									<div class="col-md-6">
										<b>Ad Soyad</b> <br>
										{{$cargo->sender->name ?? ''}} {{$cargo->sender->surname ?? ''}} <br><br>
						
										<b>Ülke ve Şehir</b><br>
										{{$cargo->sender->country ?? ''}} {{$cargo->sender->city ?? ''}}<br><br>
									</div>
									<div class="col-md-6">
					
										<b>Telefon</b><br>
										{{$cargo->sender->phone ?? ''}}<br><br>
										<b>Address</b><br>
										{{$cargo->sender->address ?? ''}}<br><br>
									</div>
									
									@endif
								</div>
							</div>
						</div>
						<br>
					</div>
					{{-- Receiver --}}
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								{{$company->other_address ?? ''}}
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<i class="fa fa-hashtag" aria-hidden="true"></i> RECEIVER / ПОЛУЧАТЕЛЬ
								<hr>
								<div class="row">
									<div class="col-md-12">
										
									</div>
									@if($cargo->receiver_id != '')
									<div class="col-md-6">
										<b>Ad Soyad</b> <br>
										{{$cargo->receiver->name ?? ''}} {{$cargo->receiver->surname ?? ''}} <br><br>
										
										<b>Ülke ve Şehir</b><br>
										{{$cargo->receiver->country ?? ''}} {{$cargo->receiver->city ?? ''}}<br><br>
									</div>
									<div class="col-md-6">
										<b>Passport</b><br>
										{{$cargo->receiver->passport ?? ''}}<br><br>
										<b>Telefon</b><br>
										{{$cargo->receiver->phone}}<br><br>
										<b>Address</b><br>
										{{$cargo->receiver->address ?? ''}}<br><br>
									</div>
						
									@endif
								</div>
							</div>
						</div>
						<br>
					</div>
				</div>
			</div>

	{{-- Product List --}}
	<div class="col-md-7" >
		<div class="row">
			{{-- Cargo --}}
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<i class="fa fa-hashtag" aria-hidden="true"></i> CARGO INFORMATION  / ИНФОРМАЦИЯ О ГРУЗЕ
						
						<hr>
						<div class="row">
							<div class="col-md-6">
								<b>Total Fee / Общая комиссия</b><br>
								@if($cargo->total_price != '')
								{{$cargo->total_price ?? ''}}$
								@else
								$ 0.0
								@endif
								<br><br>
							</div>
							<div class="col-md-6">
								<b>Total Kg / Общая кг</b><br>
								{{$cargo->total_kg ?? ''}} kg<br><br>
							</div>
							<div class="col-md-6">
								<b>Payment Type / Способ оплаты</b><br>
								
									@if($cargo->payment_type == 1)
									Sender / Отправитель
									@else
									Receiver / Получатель
									@endif
							
								<br><br>
							</div>
							<div class="col-md-6">
								<b>Status / Положение дел</b><br>
								{{$cargo->cargoStatus->name ?? ''}}<br><br>
							</div>
							<div class="col-md-12">
								<b>Date / Дата</b><br>
								{{$cargo->created_at ?? ''}}<br><br>
							</div>
						</div>
					</div>
				</div>
				<br>
			</div>

		 	 {{-- Product list --}}
		 	 <div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<i class="fa fa-list" aria-hidden="true"></i> PRODUCTS LIST / СПИСОК ПРОДУКТОВ
						<hr>
						<table class="table table-bordered" id="dataTable">
							<thead>
								<tr>
									<td>#</td>
									<td>Name</td>
									<td>Piece</td>
									<td>Fee</td>
									<td>Total Fee</td>
									
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$product->name ?? ''}} </td>
									<td>{{$product->count ?? ''}} </td>
									<td>${{$product->cost ?? ''}} </td>
									<td>${{$product->total ?? ''}} </td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		{{strtoupper(Auth::user()->name ?? '')}}
<br><br><hr>
	</div>
	<div class="col-md-6">
		{{$cargo->sender->name ?? ''}} {{$cargo->sender->surname ?? ''}}
<br><br><hr>
	</div>
</div>

<p>
	{{Auth::user()->company->name ?? ''}} AND TRADING COMPANY LIMITED
</p>

</div>

<script type="text/javascript">
window.print();

</script>
</body>
</html>
