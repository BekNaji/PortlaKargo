@extends('layouts.admin')
@section('title','Kargo Bilgilerini düzenle')
@section('content')
<div class="row">
    <div class="col-md-6 offset-3 ">
        <a class="btn btn-primary " href="{{route('cargo.show',encrypt($cargo->id))}}">Geri git</a>
        <br><br>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-hashtag" aria-hidden="true"></i> Kargo Bilgilerini düzenle
                <hr>
                <form action="{{route('cargo.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$cargo->id}}" >
                    <div class="form-group">
                        <label>Toplam KG</label>
                        <input value="{{$cargo->total_kg}}" step="0.01" class="form-control" type="number" name="total_kg" required >
                    </div>
                    <div class="form-group">
                        <label>Kargo Durumu</label>
                        <select class="form-control" name="status" required>
                            <option >Seç</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}"
                                {{($cargo->status == $status->id) ? "selected":''}}
                                >{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ödeme Türü</label>
                        <select class="form-control" name="payment_type" required>
                            <option selected disabled>Seç</option>
                            <option value="1" 
                            {{$cargo->payment_type == 1 ? "selected":""}}
                            >Gönderıcı Öder</option>
                            <option value="2"
                            {{$cargo->payment_type == 2 ? "selected":""}}
                            >Alıcı Öder</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.customer.script')
@endsection