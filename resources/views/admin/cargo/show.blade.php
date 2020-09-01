@extends('layouts.admin')
@section('title','Kargo Detay')
@section('content')

<div class="row">
	<div class="col-md-12">
		<br><br>
		<div class="col-md-12">
			<a href="{{route('cargo.index')}}" class="btn btn-primary">Geri git</a>
		</div>
		
	
	</div>
	<div class="col-md-4">

		{{-- Sender  --}}
		<div class="col-md-12">

			<br><br>

			<div class="card">
				<div class="card-body">
					<i class="fa fa-hashtag" aria-hidden="true"></i> Göderici Bilgileri
					<hr>
					<div class="row">
						@if($cargo->sender_id != '')
						<div class="col-md-6">
							<b>Ad Soyad</b> <br>
							{{$cargo->sender->name}} {{$cargo->sender->surname}} <br><br>
							<b>Email</b><br>
							{{$cargo->sender->email}}<br><br>
							<b>Ülke ve Şehir</b><br>
							{{$cargo->sender->country}} {{$cargo->sender->city}}<br><br>
						</div>
						<div class="col-md-6">
							<b>Passport</b><br>
							{{$cargo->sender->passport}}<br><br>
							<b>Telefon</b><br>
							{{$cargo->sender->phone}}<br><br>
							<b>Address</b><br>
							{{$cargo->sender->address}}<br><br>
						</div>
						<a class="btn btn-warning" 
						href="{{route('customer.edit',[encrypt($cargo->sender_id),$cargo->id])}}">Düzenle</a>&nbsp;
						@else
						<a class="btn btn-success" 
						href="{{route('customer.create',encrypt($cargo->id))}}">Gönderici Ekle</a>
						@endif
						@if($cargo->sender->telegram_id)
							<a  
							class="btn btn-primary" 
							href="{{route('telegram.send.message',$cargo->id)}}">Telegram Mesaj Gönder!</a>
							@endif
					</div>
				</div>
			</div>
			<br>
		</div>
		{{-- Receiver --}}
		<div class="col-md-12">

			<div class="card">
				<div class="card-body">
					<i class="fa fa-hashtag" aria-hidden="true"></i> Alıcı Bilgileri
					<hr>
					<div class="row">
						@if($cargo->receiver_id != '')
						<div class="col-md-6">
							<b>Ad Soyad</b> <br>
							{{$cargo->receiver->name}} {{$cargo->receiver->surname}} <br><br>
							<b>Email</b><br>
							{{$cargo->receiver->email}}<br><br>
							<b>Ülke ve Şehir</b><br>
							{{$cargo->receiver->country}} {{$cargo->receiver->city}}<br><br>
						</div>
						<div class="col-md-6">
							<b>Passport</b><br>
							{{$cargo->receiver->passport}}<br><br>
							<b>Telefon</b><br>
							{{$cargo->receiver->phone}}<br><br>
							<b>Address</b><br>
							{{$cargo->receiver->address}}<br><br>
						</div>
						<a class="btn btn-warning" 
						href="{{route('receiver.edit',
						[encrypt($cargo->receiver_id),$cargo->id])}}">Düzenle</a>
						@else
						<a class="btn btn-success" 
						href="{{route('receiver.create',encrypt($cargo->id))}}">Gönderici Ekle</a>
						@endif
					</div>
				</div>
			</div>
			<br>
		</div>
		
		
	</div>

	{{-- Product List --}}
	<div class="col-md-8" >
		<div class="row">
			{{-- Cargo --}}
			<div class="col-md-12">
				<br><br>
				<div class="card">
					<div class="card-body">
						<i class="fa fa-hashtag" aria-hidden="true"></i> Kargo Bilgileri
						<span class="float-right "><input type="text" readonly value="{{$cargo->number}}"></span>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<b>Toplam Ücret</b><br>
								@if($cargo->total_price != '')
								{{$cargo->total_price}}$
								@else
								$ 0.0
								@endif
								<br><br>
							</div>
							<div class="col-md-6">
								<b>Toplam Kg</b><br>
								{{$cargo->total_kg}} kg<br><br>
							</div>
							<div class="col-md-6">
								<b>Ödeme Türü</b><br>
								
									@if($cargo->payment_type == 1)
									Gönderici Öder
									@else
									Alıcı Öder
									@endif
								
								<br><br>
							</div>
							<div class="col-md-6">
								<b>Status</b><br>
								{{$cargo->cargoStatus->name}}<br><br>
							</div>
							<div class="col-md-12">
								<b>Tarih</b><br>
								{{$cargo->created_at}}<br><br>
							</div>
							<a class="btn btn-warning" 
							href="{{route('cargo.edit',
							[encrypt($cargo->id)])}}">Düzenle</a>
							&nbsp;
							<a type="submit" target="_blank" 
							   href="{{route('cargo.pdf',encrypt($cargo->id))}}" class="btn btn-info">
							   <i class="fa fa-print"></i>
							</a>
							


						</div>
					</div>
				</div>
				<br>
			</div>

		 	 {{-- Product list --}}
		 	 <div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<i class="fa fa-list" aria-hidden="true"></i> Ürünler Listesi&#160;&#160;&#160;
						<button id="create" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></button> &nbsp;
						<hr>
						<table class="table table-bordered" id="dataTable">
							<thead>
								<tr>
									<td>#</td>
									<td>Ad</td>
									<td>Adet</td>
									<td>Ücret</td>
									<td>Toplam Ücret</td>
									<td>#</td>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$product->name}} </td>
									<td>{{$product->count}} </td>
									<td>${{$product->cost}} </td>
									<td>${{$product->total}} </td>
									<td>
										<button id="edit"
										data-id="{{$product->id}}"
										data-name="{{$product->name}}"
										data-count="{{$product->count}}"
										data-cost="{{$product->cost}}"
										data-total="{{$product->total_cost}}"
										class="btn btn-warning"><i class="fa fa-edit"></i></button>
										<a id="delete" data-id="{{$product->id}}"
										data-name="{{$product->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
									</td>
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
@include('admin.product.createModal')
@include('admin.product.deleteModal')
@include('admin.product.editModal')
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function(){
// Product Delete Modal
$(document).on('click','#delete',function(){
id = $(this).data('id');
name = $(this).data('name');
$('#id').val(id);
$('#name').text(name);
$('#deleteModal').modal('show');
});
// product edit Modal
$(document).on('click','#edit',function(){
			id 			= $(this).data('id');
		name 		= $(this).data('name');
		count 		= $(this).data('count');
		cost 		= $(this).data('cost');
total = $(this).data('total');
$('#productId').val(id);
$('.name').val(name);
$('#count').val(count);
$('#cost').val(cost);
$('#total').val(count*cost);
$('#editModal').modal('show');
});
// product create modal
$(document).on('click','#create',function(){
$('#createModal').modal('show');
});
// product calculate cost for createModal
$(document).on('keyup','.cost',function(){
var count = $('.count').val();
var price = $('.cost').val();
$('.total').val(count*price);
});
// product calculate count for createModal
$(document).on('keyup','.count',function(){
var count = $('.count').val();
var price = $('.cost').val();
$('.total').val(count*price);
});
// product calculate for edit Modal
$(document).on('keyup','#cost',function(){
var count = $('#count').val();
var price = $('#cost').val();
$('#total').val(count*price);
});
// product calculate for edit Modal
$(document).on('keyup','#count',function(){
var count = $('#count').val();
var price = $('#cost').val();
$('#total').val(count*price);
});
});
</script>
@endsection