@extends('layouts.admin')
@section('title','Alıcının Tüm kargoları')
@section('content')
<br><br>
<div class="card">
    <div class="card-body">
        <b>Gönderici Bilgileri </b><hr>
    <p><b>Ad Soyad: </b> {{ $sender->name }}</p>
    <p><b>Telefon: </b>{{ $sender->phone}}</p>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <b class="mr-4">Göndericinin Tüm kargoları</b>
        <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
        <hr>
        <table id="dataTable" class="display responsive nowrap table-responsive table-bordered" width="100%" >
            <thead>
                <tr>
                    
                    <td><b>#</b></td>
                    <td><b>Kullanıcı</b></td>
                    <td><b>Takip No</b></td>
                    <td><b>Durum</b></td>
                    <td><b>Ödeme</b></td>
                    <td><b>Göderici</b></td>
                    <td><b>Alıcı</b></td>
                    <td><b>Toplam Kg</b></td>
                    <td><b>Kargo Ücreti</b></td>
                    <td><b>Oluşturma Tarih</b></td>
                    <td><b>#</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                <tr>
                    
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $cargo->user->name ?? ''}}</td>
                    <td>{{$cargo->number ?? ''}}</td>
                    <td>{{$cargo->cargoStatus->name ?? ''}}</td>
                    <td>
                        @if($cargo->payment_type == 1)
                        Göderici Öder
                        @elseif($cargo->payment_type ==2)
                        Alıcı Öder
                        @endif
                    </td>
                    <td>{{$cargo->sender->name ?? ''}} {{$cargo->sender->surname ?? ''}}</td>
                    <td>{{$cargo->receiver->name ?? ''}} {{$cargo->receiver->surname ?? ''}}</td>
                    <td>{{$cargo->total_kg ?? ''}}KG</td>
                    <td>{{$cargo->cargo_price ?? '$0.0'}}</td>
                    <td>{{$cargo->created_at->toDateString()}}</td>
                    <td>
        
                        <a type="submit" target="_blank" 
                            href="{{route('cargo.print',encrypt($cargo->id))}}" >
                            <span class="badge badge-info">
                            <i class="fa fa-print"></i>
                            </span>
                        </a>
        
                        
                        <a type="submit"
                            href="{{route('cargo.show',encrypt($cargo->id))}}" >
                            <span class="badge badge-warning">
                            <i class="fa fa-edit"></i>
                            </span>
                        </a>
    
                        <a id="delete" data-id="{{$cargo->id}}"
                            data-name="{{$cargo->number}}"
                        href="#delete">
                        <span class="badge badge-danger">
                        <i class="fa fa-trash-alt "></i>
                        </span>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.customer.filterModal')
@include('admin.customer.deliveryModal')
@endsection