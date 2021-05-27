@extends('layouts.admin')
@section('title','Soru ve Cevap düzenleme')
@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h3>Soru ve Cevap düzenleme Formu</h3>
                <form action="{{route('faq.update',$faq->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Soru</label>
                        <textarea name="ask"  cols="30" rows="10" class="form-control">{{old('ask') ?? $faq->title ?? ''}}</textarea>
                        @error('ask')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Cevap</label>
                        <textarea name="answer"  cols="30" rows="10" class="form-control">{{ old('answer') ?? $faq->description ?? '' }}</textarea>
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
