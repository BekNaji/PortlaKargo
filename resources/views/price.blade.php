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
					

					<div class="col-md-4">

						<div class="card">
							<div class="card-header">
								Başlangıç
							</div>
							<div class="card-body">
								<center>
								<h1>$0</h1>
								<p>* 1 Ay </p>
								<p>* Sınırsız Kargo kaydı</p>
								<p>* Sınırsız Kullanıcı</p>
								<p>* Sınrısız Telegram bilgilendirmesi</p>
								<p>* SMS bilgilendirmesi 0 adet</p>
								</center>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">
								Seç
								</button>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								Orta
							</div>
							<div class="card-body">
								<center>
								<h1>$10</h1>
								<p>* 3 Ay</p>
								<p>* Sınırsız Kargo kaydı</p>
								<p>* Sınırsız Kullanıcı</p>
								<p>* Telegram bilgilendirmesi</p>
								<p>* SMS bilgilendirmesi 1000 adet</p>
								</center>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">
								Seç
								</button>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								Pro
							</div>
							<div class="card-body">
								<center>
								<h1>$20</h1>
								<p>* 3 Ay</p>
								<p>* Sınırsız Kargo kaydı</p>
								<p>* Sınırsız Kullanıcı</p>
								<p>* Sınrısız Telegram bilgilendirmesi</p>
								<p>* SMS bilgilendirmesi 2000 adet</p>
								</center>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">
								Seç
								</button>
							</div>
						</div>
					</div>
					<div class="col-md-8 offset-sm-2">
						<br>
						<div class="card">
							<div class="card-header">
								Özel
							</div>
							<div class="card-body">
								<center>
								<h1>Özel</h1>
								<p>* Ay</p>
								<p>* Sınırsız Kargo kaydı</p>
								<p>* Sınırsız Kullanıcı</p>
								<p>* Sınrısız Telegram bilgilendirmesi</p>
								<p>* SMS bilgilendirmesi *** adet</p>
								</center>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">
								Seç
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