@extends('layouts.app')

@section('content')

    <div class="col-md-10 offset-md-1">
        <a class="btn btn-primary" href="{{route('delivery.index')}}">Geri git</a>
        <div class="card mt-3">
             <div class="card-body">
                 <h4>Socuçlar</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Status</th>
                                <th>Gönderici</th>
                                <th>Gönderici Tel</th>
                                <th>Alıcı</th>
                                <th>Passport</th>
                                <th>Telefon 1</th>
                                <th>Telefon 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cargos as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->number}}</td>
                                <td>{{$item->cargoStatus->name}}</td>
                                <td>{{$item->sender->name}}</td>
                                <td>{{$item->sender->phone}}</td>
                                <td>{{$item->receiver->name}}</td>
                                <td>{{$item->receiver->passport}}</td>
                                <td>{{$item->receiver->phone}}</td>
                                <td>{{$item->receiver->other_phone}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td>Veri bulunamadi!</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                
                <form action="{{route('delivery.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <b>Teslim Edilecek Kargo Numaralari seçiniz</b><br>
                        @forelse ($cargos as $item)
                        <input checked id="number{{$item->id}}" type="checkbox" name="numbers[]" value="{{$item->id}}"> 
                        <label for="number{{$item->id}}">{{$item->number}}</label>
                        <br>
                        @empty
                            <p>Veri Bulunamadi</p>
                        @endforelse
                       
                    </div>
                    <div class="form-group">
                        <label>Teslim Alan Pasaport | Kendi resmi</label>
                        <input class="form-control" type="file" name="receiver_image">
                    </div>
                    <div class="form-group">
                        <label>Teslim Alan Ad ve Soyad</label>
                        <input class="form-control" type="text" name="receiver">
                    </div>
                    <div class="form-group">
                        @if($statuses->count() != '')
                        <select class="form-control" name="status" required>
                            <option value="" selected>Seç</option>
                            
                            @foreach($statuses as $status)
                            <option value="{{$status->id ?? ''}}">{{$status->name ?? ''}} </option>
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
    </div>

@endsection