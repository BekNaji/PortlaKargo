@extends('layouts.admin')
@section('title','Kargo Ekle')
@section('content')
<form target="_blank" action="{{route('cargo.store.all')}}" method="POST">
	@csrf
	<div class="row">
		
		<div class="col-md-8">
			<br>
			<table class="table-bordered" style="width:100%;" >
				<tr>
					<td style="padding-left: 15px;padding-right: 15px;">No:</td>
					<td style="padding-left: 15px;padding-right: 15px;">НАЗВАНИЕ</td>
					<td style="padding-left: 15px;padding-right: 15px;">Кол-вo</td>
					<td style="padding-left: 15px;padding-right: 15px;">Цена за ед.</td>
					<td style="padding-left: 15px;padding-right: 15px;">Цена</td>
				</tr>
				
				<?php for($i=1; $i<25; $i++){ ?>
				<tr>
					<td><?php echo $i ?></td>

					<td><input style="width:100%;"
					name="product_name[]" type="text"></td>
					<td>
						<input style="width:100%;"
						value="0" 
						name="product_count[]" 
						type="number" step="0.1"
						class="product_count count{{$i}}" data-id="{{$i}}" 
						min="0"

						>
					</td>
					<td>
						<input 
						value="0" 
						type="number" step="0.1" 
						style="width:100%;" name="product_price[]" type="text"
						class="product_price price{{$i}}" data-id="{{$i}}"
						min="0" 
						>
					</td>
					<td><input value="0" 
						min="0"
					 class="total_price{{$i}}" type="number" step="0.1" style="width:100%;" name="product_total_price[]" type="text" readonly></td>
				</tr>
				<?php } ?>
				
			</table>

		</div>
		<div class="col-md-4">
			{{-- sender info --}}
			<br>
			<table class="table-bordered" style="width:100%">
				<tr>
					<td class="text-center" style="padding:5px;" colspan="2">Gönderici bilgileri</td>
				</tr>
			
				{{-- sender name --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Ad Soyad</b></td>
					<td><input style="width:100%" type="text" name="sender_name" required max="255">
					</td>
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
								<input maxlength="10" minlength="10" style="width:100%" type="text" name="sender_phone" required>
							</div>
						</div>
					</td>
				</tr>
			</table>
			{{-- receiver info --}}
			<br>
			<table class="table-bordered" style="width:100%">
				<tr>
					<td class="text-center" style="padding:5px;" colspan="2">Alıcı bilgileri</td>
				</tr>
				
				{{-- Receiver name --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Ad Soyad</b></td>
					<td><input style="width:100%" type="text" name="receiver_name" required></td>
				</tr>
				{{-- receiver passport --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Passport</b></td>
					<td><input style="width:100%" type="text" name="receiver_passport" required></td>
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
								<input maxlength="9" minlength="9" style="width:100%" type="text" name="receiver_phone" required>
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
								<input  maxlength="9" style="width:100%" type="text" name="receiver_other_phone" >
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
								<option value="{{$item->id}}" data-baza="{{$item->type}}">{{$item->name}}</option>
							@endforeach	
						</select>
						<select name="baza" id="baza" style="width:100%;" required>
							<option value="">Seç</option>
								<option value="1">Baza-1</option>
								<option value="2">Baza-2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Address </b></td>
					<td>
						<textarea style="width:100%" type="text" name="receiver_address" required></textarea>
					</td>
				</tr>
			</table>
			{{-- cargo info --}}
			<br>
			<table class="table-bordered" style="width:100%">
				<tr>
					<td class="text-center" style="padding:5px;" colspan="2">Kargo Bilgileri</td>
				</tr>
				<tr>
					<td>Kategori</td>
					<td>
						<select name="type" id="type" style="width:100%" required>
							<option value="posta">Posta</option>
							<option value="cargo">Kargo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kargo Kg</td>
					<td><input style="width:100%" step="0.1" type="number" name="total_kg"></td>
				</tr>
				<tr>
					<td>Kargo Ücretı</td>
					<td><input style="width:100%" step="0.1" type="number" name="cargo_price"></td>
				</tr>
				<tr>
					<td>Türkiyede alınan ücret</td>
					<td>
						<div class="row">
							<div class="col-md-6">
								TL
								<input style="width:100%" name="sender_price_tr">
							</div>
							<div class="col-md-6">
								USD
								<input style="width:100%" name="sender_price_usd">
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
								<input style="width:100%" name="receiver_price_uz">
							</div>
							<div class="col-md-6">
								USD
								<input style="width:100%" name="receiver_price_usd">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Kargo Status</td>
					<td>
						@if($statuses->count() != '')
						<select style="width:100%" name="status" required>
							<option value="" selected>Seç</option>
							
							@foreach($statuses as $status)
							<option value="{{$status->id}}">{{$status->name}}</option>
							@endforeach
						</select>
						@else
						<a href="{{route('status.cargo.index')}}">Status Ekle</a>
						@endif
					</td>
				</tr>
				<tr>
					<td>Ödeme türü</td>
					<td>
						<select style="width:100%" name="payment_type" required>
                            <option value="" selected disabled>Seç</option>
                            <option value="1">Gönderıcı Öder</option>
                            <option value="2">Alıcı Öder</option>
                        </select>
					</td>
				</tr>
			</table>
			<br>
			<button class="btn btn-success" type="submit">Kaydet</button>
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

	$('#city').change(function(){
		var baza_id = $('select#city option:selected').attr('data-baza');
		$('#baza').val(baza_id);
	});

	$(document).on('keyup','.product_price',function(){
		var row = $(this).data('id');
		var product_count = $('.count'+row).val();
		var product_price = $('.price'+row).val();
		$('.total_price'+row).val(product_count*product_price);
	});
	

</script>
@endsection