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
		<style type="text/css">
			body{
				font-size: 8px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			@csrf
			<div class="row">
				<div class="col-md-4">
					<h1>Kargo bilgileri gelecek</h1>
				</div>
				<div class="col-md-4">
					{{-- sender info --}}
					<br>
					<table class="table-bordered" style="width:100%">
						<input type="hidden" name="sender_id"
						value="{{$cargo->sender->id}}">
						<tr>
							<td class="text-center" style="padding:5px;" colspan="2"><b>Gönderici bilgileri</b></td>
						</tr>
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Tarih / Saat</b> </td>
							<td style="padding:0 15px 0 15px;">{{$cargo->sender->created_at ?? ''}}</td>
						</tr>
						{{-- sender name --}}
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Ad Soyad</b></td>
							<td style="padding:0 15px 0 15px;">{{$cargo->sender->name}}</td>
						</tr>
						
						{{-- sender phone --}}
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Telefon</b></td>
							<td style="padding:0 15px 0 15px;">{{$cargo->sender->phone}}</td>
						</tr>
					</table>
					{{-- receiver info --}}
					<br>
					<table class="table-bordered" style="width:100%">
						<input type="hidden" name="receiver_id"
						value="{{$cargo->receiver->id}}">
						<tr>
							<td class="text-center" style="padding:5px;" colspan="2"><b>Alıcı bilgileri</b></td>
						</tr>
						
						{{-- Receiver name --}}
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Ad Soyad</b></td>
							<td style="padding:0 15px 0 15px;">{{$cargo->receiver->name}}</td>
						</tr>
						{{-- receiver passport --}}
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Passport</b></td>
							<td style="padding:0 15px 0 15px;">{{$cargo->receiver->passport}}</td>
						</tr>
						{{-- sender phone --}}
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Telefon </b></td>
							<td style="padding:0 15px 0 15px;">{{$cargo->receiver->phone}}
							</td>
						</tr>
						
						<tr>
							<td style="padding:0 15px 0 15px;"><b>Address </b></td>
							<td style="padding:0 15px 0 15px;">
								{{$cargo->receiver->address}}
							</td>
						</tr>
					</table>
					{{-- cargo info --}}
					
					
				</div>
				<div class="col-md-4">
					<br>
					<table class="table-bordered" style="width:100%">
						<input type="hidden" name="cargo_id"
						value="{{$cargo->id}}">
						<tr>
							<td class="text-center" style="padding:5px;" colspan="2"><b>Kargo Bilgileri</b></td>
						</tr>
						<tr>
							<td colspan="2" class="text-center"><h1>{{$cargo->number ?? ''}}</h1></td>
						</tr>
						<tr>
							<td>Kargo Kg</td>
							<td style="padding:0 15px 0 15px;">{{$cargo->total_kg}}</td>
						</tr>
						<tr>
							<td>Kargo Ücretı</td>
							<td style="padding:0 15px 0 15px;">{{$cargo->cargo_price}}</td>
						</tr>
						<tr>
							<td>Ödeme türü</td>
							<td style="padding:0 15px 0 15px;">
								{{$cargo->payment_type == 1 ? "Gönderıcı Öder":""}}
								
								
								{{$cargo->payment_type == 2 ? "Alıcı Öder":""}}
								
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-12">
					<br>
					<table class="table-bordered" style="width:100%;" >
						<tr>
							<td style="padding-left: 15px;padding-right: 15px;">No:</td>
							<td style="padding-left: 15px;padding-right: 15px;">НАЗВАНИЕ</td>
							<td style="padding-left: 15px;padding-right: 15px;">Кол-вo</td>
							<td style="padding-left: 15px;padding-right: 15px;">Весь несто</td>
							<td style="padding-left: 15px;padding-right: 15px;">Вес брутто</td>
							<td style="padding-left: 15px;padding-right: 15px;">Цена за ед.</td>
							<td style="padding-left: 15px;padding-right: 15px;">Цена</td>
						</tr>
						
						<?php $key = 0; for($i=1; $i<25; $i++){ ?>
						<tr>
							<input type="hidden" name="product_id"
							value="{{$products[$key]->id ?? ''}}">
							<td><?php echo $i ?></td>
							<td>{{ $products[$key]->name ?? ''}}</td>
							<td>{{ $products[$key]->count ?? ''}}</td>
							<td>
							{{ $products[$key]->product_kg ?? ''}}</td>
							<td>
							{{ $products[$key]->product_total_kg ?? ''}}</td>
							<td>
								{{ $products[$key]->cost ?? ''}}
							</td>
							<td>{{ $products[$key]->total ?? ''}}</td>
						</tr>
						<?php $key++; } ?>
					</table>
				</div>
				
			</div>
		</div>
		<script type="text/javascript">
		window.print();
		</script>
	</body>
</html>