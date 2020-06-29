@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-body">
            	@if(session('message'))
            	<div class="alert alert-info">
				<strong>{{session('message')}}</strong>
				</div>
            	@endif
            	<div class="alert alert-info">
				<strong>Kaydınız daha onaylanmamiştır! <b>bekturk333@gmail.com</b> adresinden bizimle iletişime geçiniz!</strong>
				</div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection