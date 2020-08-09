@extends('layouts.admin')
@section('title','Alıcı Ekle')
@section('content')
<br><br>
<div class="row">
    <div class="col-md-6 offset-3 ">
        <a class="btn btn-primary " href="{{route('cargo.show',$cargoId)}}">Geri git</a>
        <br><br>
        
        <div class="card">
            <div class="card-body">
                <i class="fa fa-hashtag" aria-hidden="true"></i> Alıcı Bilgileri
                <hr>
                <div class="alert alert-info">
                    <strong>Bilgilendirme!</strong> Eğer Alıcı bilgileri sistemde kayıtlı ise passport kısmını doldurun, otomatik tüm bilgileri getirecektir.
                </div>
                <form action="{{route('receiver.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="cargoId" value="{{$cargoId}}">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label>Passport ID</label>
                        <input id="passport" type="text" name="passport" class="form-control">
                        <ul class="list-group" id="result">
                            
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Ad ve Soyad</label>
                        <input id="name" type="text" name="name" class="form-control" required>
                    </div>
                    {{-- <div class="form-group">
                        <label>Soyad</label>
                        <input id="surname" type="text" name="surname" class="form-control" required>
                    </div> --}}
                    <div class="form-group">
                        <label>Telefon (05550156185)</label>
                        <input id="phone" type="number" name="phone" class="form-control" required>
                    </div>
                   {{--  <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" name="email" class="form-control" >
                    </div> --}}
                   <div class="form-group">
                        <label>Ülke</label>
                        <select name="country" class="form-control">
                            <option value="Uzbekistan">Uzbekistan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Şehir</label>
                        <input id="city" type="text" name="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="address" class="form-control" name="address"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Devam et</button>
                </div>
            </div>
            <br>
            
            
        </div>
    </div>
</form>
@include('admin.receiver.script')
@endsection