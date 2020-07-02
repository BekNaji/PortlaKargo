@extends('layouts.admin')
@section('title','Şirket Bilgilerini düzenle')
@section('content')
<div class="row">
    <div class="col-md-6 offset-3 ">
        <br>
        <a class="btn btn-primary " href="{{route('company.index')}}">Geri git</a>
        <br><br>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-hashtag" aria-hidden="true"></i> Şirket Bilgilerini düzenle
                <hr>
                <form action="{{route('company.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$company->id}}">
                    <div class="form-group">
                        <label>Şirket Adı</label>
                        <input value="{{$company->name}}" class="form-control" type="text" name="name" required >
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{$company->email}}" class="form-control" type="text" name="email" required >
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input value="{{$company->phone}}" class="form-control" type="text" name="phone" required >
                    </div>

                    <div class="form-group">
                        <label>Statu</label>
                        <select class="form-control" name="status">
                            <option value="0"
                            {{$company->status == 0?'selected':''}}>Pasif</option>
                            <option value="1" 
                            {{$company->status == 1?'selected':''}}>Etkin</option>
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