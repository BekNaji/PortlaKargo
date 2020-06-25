@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>*</td>
                            <td>Son Durmu</td>
                            <td>Tarih ve saat</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cargoLogs as $cargoLog)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cargoLog->cargoStatus->name}}</td>
                            <td>{{$cargoLog->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection