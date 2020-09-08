@extends('layouts.admin')
@section('title','Kargo Ekle')
@section('content')
<form action="{{route('cargo.store.all')}}" method="POST">
	@csrf
	<div class="row">
		
		<div class="col-md-8">
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
				
				<?php for($i=1; $i<25; $i++){ ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><input style="width:100%;"
					name="product_name[]" type="text"></td>
					<td>
						<input style="width:100%;"
						name="product_count[]" type="number" step="0.1">
					</td>

					<td>
						<input type="number" step="0.1" style="width:100%;" name="product_kg[]" type="text">
					</td>

					<td>
						<input style="width:100%;" name="product_total_kg[]" type="text">
					</td>
					
					<td>
						<input type="number" step="0.1" style="width:100%;" name="product_price[]" type="text">
					</td>
					<td><input type="number" step="0.1" style="width:100%;" name="product_total_price[]" type="text"></td>
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
					<td><input style="width:100%" type="text" name="sender_name" required></td>
				</tr>
				
				{{-- sender phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Telefon</b></td>
					<td><input style="width:100%" type="text" name="sender_phone" required></td>
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
					<td><input style="width:100%" type="text" name="receiver_phone" required></td>
				</tr>
				{{-- sender other phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Tel 2 </b></td>
					<td>
						<input  style="width:100%" type="text" name="receiver_other_phone" >
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
					<td>Kargo Kg</td>
					<td><input style="width:100%" step="0.1" type="number" name="total_kg"></td>
				</tr>
				<tr>
					<td>Kargo Ücretı</td>
					<td><input style="width:100%" step="0.1" type="number" name="cargo_price"></td>
				</tr>
				<tr>
					<td>Cargo Status</td>
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