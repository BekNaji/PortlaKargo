@extends('layouts.admin')
@section('title',$cargo->number)
@section('content')
<form action="{{route('cargo.update.all')}}" method="POST">
	@csrf
	<div class="row">
		
		<div class="col-md-8 mt-4">
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
						min="0"
						value="{{ $products[$key]->count ?? 0}}"
						name="product_count[]" type="number" step="0.1"
						class="product_count count{{$i}}" data-id="{{$i}}"
						>
					</td>
					<td>
						<input type="number" step="0.1" style="width:100%;"
						value="{{ $products[$key]->cost ?? 0}}"
						name="product_price[]" type="text"
						class="product_price price{{$i}}" data-id="{{$i}}"
						min="0"
						>
					</td>
					<td><input type="number" step="0.1" style="width:100%;"
						value="{{ $products[$key]->total ?? 0}}"
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
			@if ($cargo->receiver_name)
				<h3>Teslim alan: {{$cargo->receiver_name ?? ''}}</h3>
			@endif
			@if ($cargo->receiver_image)
				<a href="{{asset($cargo->receiver_image)}}">{{asset($cargo->receiver_image)}}</a>
			@endif
		</div>
		<div class="col-md-4 mt-4">
			{{-- sender info --}}
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
					<td>
						<div class="row">
							<div class="col-sm-2">
								<input type="text" readonly value="90" name="sender_phone_code">
							</div>
							<div class="col-sm-10">
								<input maxlength="10" minlength="10" style="width:100%" type="text" name="sender_phone" value="{{$cargo->sender->phone()}}" required>
							</div>
						</div>
					</td>
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
					<td>
						<div class="row">
							<div class="col-sm-2">
								<input type="text" readonly value="998" >
							</div>
							<div class="col-sm-10">
								<input maxlength="9" minlength="9" style="width:100%" type="text" name="receiver_phone" value="{{$cargo->receiver->phone() ?? ''}}" required>
							</div>
						</div>
					</td>
				</tr>
				{{-- sender other phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Tel 2 </b></td>
					<td>
						<div class="row">
							<div class="col-sm-2">
								<input type="text" readonly value="998" name="receiver_phone_code" >
							</div>
							<div class="col-sm-10">
								<input maxlength="9" value="{{ $cargo->receiver->other_phone() }}"style="width:100%" type="text" name="receiver_other_phone" >
							</div>
						</div>	
					</td>
				</tr>
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Şehir</b></td>
					<td>
						<select name="city" id="city" style="width:100%;" required>
				 			<option value="">Seç</option>
							@foreach ($cities as $item)
								<option value="{{$item->id}}" data-baza="{{$item->type}}" {{$cargo->receiver->city == $item->id ? 'selected':''}}>{{$item->name}}</option>
							@endforeach	
						</select>
						<select name="baza" id="baza" style="width:100%;" required>
							<option value="">Seç</option>
								<option value="1" {{$cargo->baza == 1 ? 'selected' : ''}}>Baza-1</option>
								<option value="2" {{$cargo->baza == 2 ? 'selected' : ''}}>Baza-2</option>
						</select>
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
					<td>Kategori</td>
					<td>
						<select name="type" id="type" style="width:100%" required>
							<option value="posta" {{ $cargo->type == 'posta' ? 'selected':''}}>Posta</option>
							<option value="cargo" {{ $cargo->type == 'cargo' ? 'selected':''}}>Kargo</option>
						</select>
					</td>
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
					<td>Türkiyede alınan ücret</td>
					<td>
						<div class="row">
							<div class="col-md-6">
								TL
								<input style="width:100%" name="sender_price_tr" value="{{$cargo->sender_price_tr ?? ''}}">
							</div>
							<div class="col-md-6">
								USD
								<input style="width:100%" name="sender_price_usd" value="{{$cargo->sender_price_usd ?? ''}}">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Özbekistanda alınan ücret</td>
					<td>
						<div class="row">
							<div class="col-md-6">
								UZ 
								<input style="width:100%" name="receiver_price_uz" value="{{$cargo->receiver_price_uz ?? ''}}">
							</div>
							<div class="col-md-6">
								USD
								<input style="width:100%" name="receiver_price_usd" value="{{$cargo->receiver_price_usd ?? ''}}">
							</div>
						</div>
					</td>
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
			<a target="_blank" href="{{ route('cargo.print',encrypt($cargo->id)) }}" class="btn btn-info" type="button">Print</a>			
		</div>
	</div>
</form>
@endsection
@section('js')
<script type="text/javascript">
	$('#city').change(function(){
		var baza_id = $('select#city option:selected').attr('data-baza');
		$('#baza').val(baza_id);
	});

	var baza_id = $('select#city option:selected').attr('data-baza');

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