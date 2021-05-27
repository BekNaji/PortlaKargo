@extends('layouts.admin')
@section('title','Soru ve Cevap Ekle')
@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h3>Soru ve Cevap Formu</h3>
                <form action="{{route('faq.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Soru</label>
                        <textarea name="ask"  cols="30" rows="10" class="form-control">{{old('ask')}}</textarea>
                        @error('ask')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Cevap</label>
                        <textarea name="answer"  cols="30" rows="10" class="form-control">{{ old('answer') }}</textarea>
                        @error('answer')
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
