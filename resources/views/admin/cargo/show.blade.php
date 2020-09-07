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
				
				<?php $key = 0; for($i=1; $i<25; $i++){ ?>
				<tr>
					<input type="hidden" name="product_id" 
					value="{{$products[$key]->id ?? ''}}">
					<td><?php echo $i ?></td>
					<td><input style="width:100%;"
					name="product_name[]" 
					value="{{ $products[$key]->name ?? ''}}" type="text"></td>
					<td>
						<input style="width:100%;"
						value="{{ $products[$key]->count ?? ''}}"
						name="product_count[]" type="number" step="0.1">
					</td>

					<td>
						<input type="number" step="0.1" style="width:100%;" name="product_kg[]" 
						value="{{ $products[$key]->product_kg ?? ''}}"
						type="text"></td>
					<td>
						<input style="width:100%;" 
						value="{{ $products[$key]->product_total_kg ?? ''}}"
						name="product_total_kg[]" type="text"></td>
					<td>
						<input type="number" step="0.1" style="width:100%;"
						value="{{ $products[$key]->cost ?? ''}}"
						name="product_price[]" type="text">
					</td>
					<td><input type="number" step="0.1" style="width:100%;" 
						value="{{ $products[$key]->total ?? ''}}"
						name="product_total_price[]" type="text"></td>
				</tr>
				<?php $key++; } ?>
			</table>
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
					<td><input style="width:100%" type="text" name="sender_name" value="{{$cargo->sender->name}}" required></td>
				</tr>
				
				{{-- sender phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Telefon</b></td>
					<td><input style="width:100%" type="text" name="sender_phone" value="{{$cargo->sender->phone}}" required></td>
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
					<td><input style="width:100%" type="text" name="receiver_name" value="{{$cargo->receiver->name}}" required></td>
				</tr>
				{{-- receiver passport --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Passport</b></td>
					<td><input style="width:100%" type="text" name="receiver_passport" value="{{$cargo->receiver->passport}}" required></td>
				</tr>
				{{-- sender phone --}}
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Telefon </b></td>
					<td>
						<textarea style="width:100%" type="text" name="receiver_phone" required>{{$cargo->receiver->phone}}</textarea>
					</td>
				</tr>
				
				<tr>
					<td style="padding:0 15px 0 15px;"><b>Address </b></td>
					<td>
						<textarea style="width:100%" type="text" name="receiver_address" required>{{$cargo->receiver->address}}</textarea>
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
					<td><input style="width:100%" type="number" name="total_kg" value="{{$cargo->total_kg}}"></td>
				</tr>
				<tr>
					<td>Kargo Ücretı</td>
					<td><input style="width:100%" type="number" name="cargo_price" value="{{$cargo->cargo_price}}"></td>
				</tr>
				<tr>
					<td>Cargo Status</td>
					<td>
						
						 <select style="width:100%" name="status" required>
                            <option >Seç</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}"
                                {{($cargo->status == $status->id) ? "selected":''}}
                                >{{$status->name}}</option>
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