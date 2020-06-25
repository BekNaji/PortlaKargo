@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-6 offset-3">
		
		<a class="btn btn-primary " href="{{route('customer.index')}}">Geri git</a> 
		<br><br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-user" aria-hidden="true"></i> Müşteri Bilgilerini düzenle 
				<hr>
				      <form action="{{route('customer.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$customer->id}}">
                    <div class="form-group">
                        <label>Adı</label>
                        <input value="{{$customer->name}}" class="form-control" type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Soyad</label>
                        <input value="{{$customer->surname}}"  class="form-control" type="text" name="surname" required>
                    </div>

                    <div class="form-group">
                        <label>Passport</label>
                        <input value="{{$customer->passport}}"  class="form-control" type="text" name="passport">
                    </div>

                    <div class="form-group">
                        <label>Kimlik</label>
                        <input value="{{$customer->identity}}"  class="form-control" type="text" name="identity">
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input value="{{$customer->phone}}"  class="form-control" type="text" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{$customer->email}}"  class="form-control" type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Ülke</label>
                        <input value="{{$customer->country}}"  class="form-control" type="text" name="country" required>
                    </div>
                    <div class="form-group">
                        <label>Şehir</label>
                        <input value="{{$customer->city}}"  class="form-control" type="text" name="city" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea  name="address" class="form-control">{{$customer->address}} </textarea>
                    </div>

                    <div class="form-group">
                        <label>Passport Resmi</label>
                        <input type="file" name="passport_image">
                    </div>

                    <div class="form-group">
                        <label>Kimlik Resmi</label>
                        <input type="file" name="identity_image">
                    </div>

                    
                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
			</div>
		</div>
	</div>
</div>

@endsection