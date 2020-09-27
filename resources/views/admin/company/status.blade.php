@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
            	@if(session('message'))
            	<div class="alert alert-info">
				<strong>{{session('message')}}</strong>
				</div>
            	@endif
            	<div class="alert alert-info">
				<strong>Kaydınız daha onaylanmamiştır! Kısa sürede sizinle iletişime geçilecektir! <br> 
                    <ul class="list-unstyled footer-link">
                        <li class="d-block mb-3">
                            <span class="d-block text-black">
                                Telegram
                            </span>
                            <span><a href="https://t.me/beknaji" target="_blank" >
                                @beknaji</a>
                            </span>
                        </li>

                        <li class="d-block mb-3">
                            <span class="d-block text-black">
                                Telefon
                            </span>
                            <span><a href="tel:+90555-015-61-85"> +90555-015-61-85</a>
                            </span>
                        </li>

                        <li class="d-block mb-3">
                            <span class="d-block text-black">
                                Email
                            </span>
                            <span><a href = "mailto: bekturk333@gmail.com">bekturk333@gmail.com </a>
                            </span>
                        </li>
                        
                    </ul>
				</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf
                           <button class="btn btn-primary"  type="submit"> Farklı Kullanıcı ile Giriş yap!</button>
                        </form>
                
                
                
            </div>
        </div>
    </div>
</div>
@endsection