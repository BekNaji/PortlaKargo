@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-body">
                <h1>Hakkımızda</h1>
                {{$settings->about}}
            </div>
        </div>
    </div>
</div>
@endsection