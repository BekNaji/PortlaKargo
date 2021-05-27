@extends('layouts.admin')
@section('title','Şehir Güncelleme')
@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h3>Şehir ekelme Formu</h3>
                <form action="{{route('city.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Şehir Adı</label>
                        <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="type" required>
                            <option value="" selected>Seç</option>
                            <option value="1">Baza-1</option>
                            <option value="2">Baza-2</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                </form>
            </div>
        </div>
    </div>    
</div>

@endsection
