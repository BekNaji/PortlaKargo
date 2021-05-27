@extends('layouts.admin')
@section('title','Soru ve Cevap düzenleme')
@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h3>Adres düzenleme Formu</h3>
                <form action="{{route('address.update',$address->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Ad</label>
                        <input type="text" name="title" class="form-control" value="{{old('title') ?? $address->title ?? ''}}">
                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Adres</label>
                        <textarea name="description"  cols="30" rows="10" class="form-control">{{ old('description') ?? $address->description ?? '' }}</textarea>
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
