@extends('layouts.admin')
@section('title','Şehir Güncelleme')
@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h3>Şehir düzenleme Formu</h3>
                <form action="{{route('city.update',$city->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Şehir Adı</label>
                        <input class="form-control" type="text" name="name" required value="{{old('name') ?? $city->name}}">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="type" required>
                            <option value="" selected>Seç</option>
                            <option value="1" {{old('type') == '1' || $city->type == 1 ? 'selected' :''}}>Baza-1</option>
                            <option value="2" {{old('type') == '2' || $city->type == 2 ? 'selected' :''}}>Baza-2</option>
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
