@extends('layouts.admin')
@section('title','Müşteri Bilgilerini düzenle')
@section('content')
<div class="row">
	<div class="col-md-6 offset-3">
        <br>
        <a href="{{route('receiver.index')}}" class="btn btn-primary" >Geri git</a>
		<br><br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-user" aria-hidden="true"></i> <b>Alıcı Bilgilerini düzenle </b>
				<hr>
				<form action="{{route('receiver.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$receiver->id}}">
                    <div class="form-group">
                        <label>Ad ve Soyad</label>
                        <input value="{{$receiver->name}}" class="form-control" type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Passport</label>
                        <input value="{{$receiver->passport}}"  class="form-control" type="text" name="passport">
                    </div>
                    <div class="form-group">
                        <label>Telefon 1</label>
                        <input value="{{$receiver->phone}}"  class="form-control" type="number" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label>Telefon 2</label>
                        <input value="{{$receiver->other_phone}}"  class="form-control" type="number" name="other_phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea  name="address" class="form-control">{{$receiver->address}} </textarea>
                    </div>
                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    
                </form>
			</div>
		</div>
	</div>
</div>

@endsection