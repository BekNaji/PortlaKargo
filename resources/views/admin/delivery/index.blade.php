@extends('layouts.delivery')
@section('title','Teslimat')
@section('content')

<div class="card">
  
    <div class="card-body">
        <h3>Teslimat</h3><hr>
        <p><b>Kargo Takip numaryi giriniz!</b></p>
        <form method="GET" action="{{route('delivery.edit')}}">
            <div class="form-group">
                <label>Takip no</label>
                <input class="form-control" type="text" name="number" required>
            </div>
            <button class="btn btn-primary">Ok</button>
        </form>
    </div>
</div>

@endsection