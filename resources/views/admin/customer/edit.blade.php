@extends('layouts.admin')
@section('title','Göderici Bilgilerini düzenle')
@section('content')
<div class="row">
	<div class="col-md-6 offset-3">
		<br>
        <a href="{{route('customer.index')}}" class="btn btn-primary" >Geri git</a>
        <br><br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-user" aria-hidden="true"></i> <b>Göderici Bilgilerini düzenle</b> 
				<hr>
				    <form action="{{route('customer.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$customer->id}}">
                    <div class="form-group">
                        <label>Ad ve Soyad</label>
                        <input value="{{$customer->name}}" class="form-control" type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Telefon (05550156185)</label>
                        <input value="{{$customer->phone}}"  class="form-control" type="number" name="phone" required>
                    </div>

                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    
                </form>
			</div>
		</div>
	</div>
</div>

@endsection