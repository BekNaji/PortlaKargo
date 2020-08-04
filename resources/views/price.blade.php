@extends('layouts.web')
@section('content')
<br>
<div class="row">
	<div class="col-md-8 offset-2">
		<div class="card">
			<div class="card-body">
				<h1>{{__('home.price')}}</h1>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								{{__('home.free') }}
							</div>
							<div class="card-body">
								<center>
								<h1>$0</h1>
								<p>* 1 Ay </p>
								<p>* Sınırsız Kargo kaydı</p>
								<p>* Sınırsız Kullanıcı</p>
								<p>* Sınrısız Telegram bilgilendirmesi</p>
								
								</center>
							</div>
							<div class="card-footer">
								<a href="{{route('register')}}" class="btn btn-primary">
								{{__('home.select')}}
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								{{__('home.paid')}}
							</div>
							<div class="card-body">
								<center>
								<h1>$10</h1>
								<p>* 1 Ay</p>
								<p>* Sınırsız Kargo kaydı</p>
								<p>* Sınırsız Kullanıcı</p>
								<p>* Telegram bilgilendirmesi</p>
								
								</center>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">
								{{__('home.select')}}
								</button>
							</div>
						</div>
					</div>
				
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection