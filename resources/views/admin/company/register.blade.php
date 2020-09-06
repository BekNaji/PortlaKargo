@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
				<div class="alert alert-info">
				<strong>Kullanıcıya ait Şirket bulunamadı!</strong><p> Ürünü kullanmak için aşağdaki formu doldurabilir veya <b>bekturk@gmail.com</b> adresi ile iletişime geçebilir siniz!</p>
				</div>
            	
                <form action="{{route('company.apply')}}" method="POST">
                	@csrf
                	<div class="form-group">
                		<label>Şirket Adı</label>
                		<input class="form-control" type="text" name="name" required>
                	</div>
                	<div class="form-group">
                		<label>Email</label>
                		<input class="form-control" type="email" name="email" required>
                	</div>
                	<div class="form-group">
                		<label>Telefon ( 05550156185 )</label>
                		<input class="form-control" type="text" name="phone" required>
                	</div>
                	
                	<button class="btn btn-primary">Gönder</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection