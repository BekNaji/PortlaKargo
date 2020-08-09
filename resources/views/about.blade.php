@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h1>Hakkımızda</h1>
                <hr>
                101 Kargo hakkında
                Bu web site Türkiyede özellikle İstanbul’da bulunan, Orta Asya ülkelerine  kargo hizmeti veren şirketler için tasarlanmıştır. Kargo Takip sistemi ile gönderileri kolayca takip edebilirsiniz. <br> 
                <b>Kargo takip sistemi özellikleri  nelerdir.</b><hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <img src="{{url('images/icons/001-contacts.png')}}" width="100px" height="100px">
                                <p class="card-text">İşinizi Kolayca Online takip Edebilirsiniz!</p>
                            </div>
                        </div><br>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <img src="{{url('images/icons/002-cargo-ship.png')}}" width="100px" height="100px">
                                <p class="card-text">Kargo Nerede? Özel Takip No</p>
                            </div>
                        </div><br>
                    </div> 
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <img src="{{url('images/icons/005-mobile.png')}}" width="100px" height="100px">
                                <p class="card-text">Telegram kargo durum bilgilendirmesi!</p>
                            </div>
                        </div><br>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <img src="{{url('images/icons/003-barcode.png')}}" width="100px" height="100px">
                                <p class="card-text">Her Gönderi için Özel barkod!</p>
                            </div>
                        </div><br>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <img src="{{url('images/icons/connection.png')}}" width="100px" height="100px">
                                <p class="card-text">Sınırsız  kullanıcı!</p>
                            </div>
                        </div><br>
                    </div>
                </div>
                
              




            </div>
        </div>
    </div>
</div>
@endsection