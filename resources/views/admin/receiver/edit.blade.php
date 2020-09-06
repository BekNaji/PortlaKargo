@extends('layouts.admin')
@section('title','Müşteri Bilgilerini düzenle')
@section('content')
<div class="row">
	<div class="col-md-6 offset-3">
        <br>
        @if($type != '')
        <a href="{{route('cargo.show',encrypt($type))}}" class="btn btn-primary" >Geri git</a>
        @else
        <a href="{{route('receiver.index')}}" class="btn btn-primary" >Geri git</a>
        @endif
		<br><br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-user" aria-hidden="true"></i> Müşteri Bilgilerini düzenle 
				<hr>
				<form action="{{route('receiver.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="{{$type}}" >
                    <input type="hidden" name="id" value="{{$receiver->id}}">
                    <div class="form-group">
                        <label>Passport</label>
                        <input value="{{$receiver->passport}}"  class="form-control" type="text" name="passport">
                    </div>
                    <div class="form-group">
                        <label>Ad ve Soyad</label>
                        <input value="{{$receiver->name}}" class="form-control" type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input value="{{$receiver->phone}}"  class="form-control" type="number" name="phone" required>
                    </div>

                   {{--  <div class="form-group">
                        <label>Email</label>
                        <input value="{{$receiver->email}}"  class="form-control" type="email" name="email" >
                    </div> --}}
                    <div class="form-group">
                        <label>Ülke</label>
                        <select name="country" class="form-control">
                            <option value="Uzbekistan">Uzbekistan</option>
                             <option value="Turkiye">Turkiye</option>          
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Kazakhistan">Kazakhistan</option>
                            <option value="Tajikistan">Tajikistan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Şehir</label>
                        <input value="{{$receiver->city}}"  class="form-control" type="text" name="city" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea  name="address" class="form-control">{{$receiver->address}} </textarea>
                    </div>

                    <div class="form-group">
                        <label>Passport Resmi</label>
                        <input type="file" name="passport_image">
                    </div>
                    
                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    
                </form>
			</div>
		</div>
	</div>
</div>

@endsection