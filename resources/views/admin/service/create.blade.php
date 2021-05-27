@extends('layouts.admin')
@section('title','Hizmet Ekle')
@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h3>Hizmet ekleme Formu</h3>
                <form action="{{route('service.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Hizmet Adı</label>
                        <input class="form-control" type="text" name="title" required value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="description"  cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
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
