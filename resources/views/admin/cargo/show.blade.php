@extends('layouts.admin')
@section('title','Kargo Güncelle')
@section('content')
<form action="{{route('cargo.update.all')}}" method="POST">
	@csrf
	<div class="row">
		
		<div class="col-md-8">
			<br>
			<table class="table-bordered" style="width:100%;" >
				<tr>
					<td style="padding-left: 15px;padding-right: 15px;"><b>No:</b></td>
					<td style="padding-left: 15px;padding-right: 15px;"><b>НАЗВАНИЕ</b></td>
					<td style="padding-left: 15px;padding-right: 15px;"><b>Кол-вo</b></td>
					<td style="padding-left: 15px;padding-right: 15px;"><b>Цена за ед.</b></td>
					<td style="padding-left: 15px;padding-right: 15px;"><b>Цена</b></td>
				</tr>
				
				<?php $key = 0; for($i=1; $i<21; $i++){ ?>
				<tr>
					
					<td>{{$i}}
						<input
						type="hidden"
						name="product_id[]"
						value ="{{ $products[$key]->id ?? ''}}">
					</td>
					<td>
						<input style="width:100%;"
						name="product_name[]"
						value="{{ $products[$key]->name ?? ''}}" type="text">
					</td>
					<td>
						<input style="width:100%;"
						value="{{ $products[$key]->count ?? ''}}"
						name="product_count[]" type="number" step="0.1"
						class="product_count count{{$i}}" data-id="{{$i}}"
						>
					</td>
					<td>
						<input type="number" step="0.1" style="width:100%;"
						value="{{ $products[$key]->cost ?? ''}}"
						name="product_price[]" type="text"
						class="product_price price{{$i}}" data-id="{{$i}}"
						>
					</td>
					<td><input type="number" step="0.1" style="width:100%;"
						value="{{ $products[$key]->total ?? ''}}"
						name="product_total_price[]" type="text"
						class="total_price{{$i}}"
						readonly
						>
					</td>
				</tr>
				<?php $key++; } ?>
				<tr>
					<td style="padding-left: 15px;padding-right: 15px;" 
					colspan="3" rowspan="2">
						<p>Decelaration Statment. I hereby certify that the information in this invoice is true and correct and the contents and value of this shipment is a stated above</p>
					</td>
					<td style="padding-left: 15px;padding-right: 15px;" >
					<center><h6>TOTAL WEIGHT </h6></center></td>
					<td style="padding-left: 15px;padding-right: 15px;" colspan="2">
						<h6>{{$cargo->total_kg ?? '0'}} KG</h6>
					</td>
				</tr>
				<tr>
					
					<td style="padding-left: 15px;padding-right: 15px;" >
					<center><h6>TOTAL PRICE </h6></center></td>
					<td style="padding-left: 15px;padding-right: 15px;" colspan="2">
						<h6>{{$cargo->total_price ?? '0'}} $</h6>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-4">
			{{-- sender info --}}
			<br>
			<table class="table-bordered" style="width:100%">
				<input type="hidden" name="sender_id"
				value="{{$cargo->sender->id ?? ''}}">
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
					<td><input style="width:100%" type="text" name="sender_name" value="{{$cargo->sender->name ?? ''}}" required></td>
				</tr>
				
				{{-- sender phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Telefon</b></td>
					<td><input style="width:100%" type="text" name="sender_phone" value="{{$cargo->sender->phone ?? ''}}" required></td>
				</tr>
			</table>
			{{-- receiver info --}}
			<br>
			<table class="table-bordered" style="width:100%">
				<input type="hidden" name="receiver_id"
				value="{{$cargo->receiver->id ?? ''}}">
				<tr>
					<td class="text-center" style="padding:5px;" colspan="2"><b>Alıcı bilgileri</b></td>
				</tr>
				
				{{-- Receiver name --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Ad Soyad</b></td>
					<td><input style="width:100%" type="text" name="receiver_name" value="{{$cargo->receiver->name ?? ''}}" required></td>
				</tr>
				{{-- receiver passport --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Passport</b></td>
					<td><input style="width:100%" type="text" name="receiver_passport" value="{{$cargo->receiver->passport ?? ''}}" required></td>
				</tr>
				{{-- revceiver phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Tel 1</b></td>
					<td><input style="width:100%" type="text" name="receiver_phone" value="{{$cargo->receiver->phone ?? ''}}" required></td>
				</tr>
				{{-- sender other phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Tel 2 </b></td>
					<td>
						<input value="{{$cargo->receiver->other_phone ?? ''}}"
						style="width:100%" type="text" name="receiver_other_phone" >
					</td>
				</tr>
				
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Address </b></td>
					<td>
						<textarea style="width:100%" type="text" name="receiver_address" required>{{$cargo->receiver->address ?? ''}}</textarea>
					</td>
				</tr>
			</table>
			{{-- cargo info --}}
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
					<td><input style="width:100%" step="0.1" type="number" name="total_kg" value="{{$cargo->total_kg ?? ''}}"></td>
				</tr>
				<tr>
					<td>Kargo Ücretı</td>
					<td><input style="width:100%" step="0.1" type="number" name="cargo_price" value="{{$cargo->cargo_price ?? ''}}"></td>
				</tr>
				<tr>
					<td>Cargo Status</td>
					<td>
						
						<select style="width:100%" name="status" required>
							<option >Seç</option>
							@foreach($statuses as $status)
							<option value="{{$status->id}}"
								{{($cargo->status == $status->id) ? "selected":''}}
							>{{$status->name ?? ''}}</option>
							@endforeach
						</select>
						
					</td>
				</tr>
				<tr>
					<td>Ödeme türü</td>
					<td>
						<select style="width:100%" name="payment_type" required>
							
							<option value="1"
								{{$cargo->payment_type == 1 ? "selected":""}}
							>Gönderıcı Öder</option>
							<option value="2"
								{{$cargo->payment_type == 2 ? "selected":""}}
							>Alıcı Öder</option>
						</select>
					</td>
				</tr>
			</table>
			<br>
			<button class="btn btn-success" type="submit">Güncelle</button>
			<a target="_blank" href="{{route('cargo.print',encrypt($cargo->id))}}" class="btn btn-info" type="button">Print</a>
		</div>
	</div>
</form>
@endsection
@section('js')
<script type="text/javascript">
	
	$(document).on('keyup','.product_count',function(){
		var row = $(this).data('id');
		var product_count = $('.count'+row).val();
		var product_price = $('.price'+row).val();
		$('.total_price'+row).val(product_count*product_price);
	});
	$(document).on('keyup','.product_price',function(){
		var row = $(this).data('id');
		var product_count = $('.count'+row).val();
		var product_price = $('.price'+row).val();
		$('.total_price'+row).val(product_count*product_price);
	});
	
</script>
@endsection