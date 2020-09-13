@extends('layouts.delivery')

@section('content')
<a class="btn btn-primary" href="{{route('delivery.index')}}">Geri git</a>
<br><br>
<div class="card">
     <div class="card-body">
        <h3>Invoice NO: {{ $cargo->number ?? ''}} <br> </h3>
        <p class="p-2 bg-info rounded"><b>{{$cargo->cargoStatus->name}}</b></p>
        <hr>
        <b>Gönderen: </b>{{$cargo->sender->name ?? ''}} <br>
        <b>Tel: </b> {{$cargo->sender->phone ?? ''}} <br>
        <hr>
        <b>Alıcı: </b> {{$cargo->receiver->name ?? ''}} <br>
        <b>Passport: </b>{{$cargo->receiver->passport ?? ''}} <br>
        <b>Telefon: </b> {{$cargo->receiver->phone ?? ''}} <br>
        <b>Telefon: </b> {{$cargo->receiver->other_phone ?? ''}} <br> <hr>
    </div>
</div><br>
<div class="card">
    <div class="card-body">
        
        <form action="{{route('delivery.store')}}">
            @csrf
            <input type="hidden" name="id" value="{{$cargo->id}}">
            <div class="form-group">
                <label>Teslim Alan Ad ve Soyad</label>
                <input class="form-control" type="text" name="receiver">
            </div>
            <div class="form-group">
                @if($statuses->count() != '')
                <select class="form-control" name="status" required>
                    <option value="" selected>Seç</option>
                    
                    @foreach($statuses as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                @else
                <a href="{{route('status.cargo.index')}}">Status Ekle</a>
                
                @endif
            </div>
            <button class="btn btn-primary">Kaydet!</button>
        </form>
    </div>
</div>
@endsection