@extends('layouts.admin')
@section('content')
<br><br>
<div class="row">
    <div class="col-md-6 offset-3 ">
        <a class="btn btn-primary " href="{{route('cargo.index')}}">Geri git</a>
        <br><br>
        
        <div class="card">
            <div class="card-body">
                <i class="fa fa-hashtag" aria-hidden="true"></i> Gönderici Bilgileri
                <hr>
                <div class="alert alert-info">
                    <strong>Bilgilendirme!</strong> Eğer Gönderici bilgileri sistemde kayıtlı ise passport kısmını doldurun, otomatik tüm bilgileri getirecektir.
                </div>
                <form action="{{route('product.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Passport ID</label>
                        <input id="sender_passport" type="text" name="sender_passport" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Ad</label>
                        <input id="sender_name" type="text" name="sender_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Soyad</label>
                        <input id="sender_surname" type="text" name="sender_surname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input id="sender_phone" type="text" name="sender_phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input id="sender_email" type="email" name="sender_email" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Ülke</label>
                        <input id="sender_country" type="text" name="sender_country" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Şehir</label>
                        <input id="sender_city" type="text" name="sender_city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="sender_address" class="form-control" name="sender_address"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Devam et</button>
                </div>
            </div>
            <br>
            
            
        </div>
    </div>
</form>
@include('admin.product.script')
@endsection