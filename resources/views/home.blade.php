@extends('layouts.web')
@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay" style="background-image: url('https://source.unsplash.com/pSyfecRCBQA/1920x780')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>Kargo Takip Numaranızı giriniz!</h1>
                    <p class="mb-5">Kargo gönderirken size verilmiş kargo takip numar <br>Örnek: KFT0012345</p>
                    <form action="{{route('search')}}" method="GET">
                        <div class="form-group d-flex">
                            <input name="key" type="text" class="form-control" placeholder="Kargo Takip Numaranızı giriniz" required>
                            <input type="submit" class="btn btn-primary text-white px-4" value="Ara">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END .ftco-cover-1 -->
    <div class="ftco-service-image-1 pb-5">
        <div class="container">
            <div class="owl-carousel owl-all">
                
                <div class="service text-center">
                    <a href="#"><img src="{{asset('web')}}/images/cargo_air_small.jpg" alt="Image" class="img-fluid"></a>
                    <div class="px-md-3">
                        <h3><a href="#">Hava Taşımacılığı</a></h3>
                        <p>Uluslararası havayolu taşımaları ve tamamlayıcı servis taleplerini karşılayacak hava nakliye hizmeti sunuyoruz.</p>
                    </div>
                </div>
                <div class="service text-center">
                    <a href="#"><img src="{{asset('web')}}/images/cargo_sea_small.jpg" alt="Image" class="img-fluid"></a>
                    <div class="px-md-3">
                        <h3><a href="#">Deniz taşımacılığı</a></h3>
                        <p>Deniz yolu ulaşımı, gemi, vapur, ve benzeri deniz araçlarıyla yapılmakta olan bir ulaşım şeklidir. .</p>
                    </div>
                </div>
                <div class="service text-center">
                    <a href="#"><img src="{{asset('web')}}/images/cargo_delivery_small.jpg" alt="Image" class="img-fluid"></a>
                    <div class="px-md-3">
                        <h3><a href="#">Teslimat</a></h3>
                        <p>Hızlı,Güvenlı ve zamanında kapınıza teslimat yapmaktayız</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="site-section bg-light" id="about">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <div class="block-heading-1">
                    <h2>Ne teklif ediyoruz </h2>
                    <p>
                    Bu web site Türkiyede özellikle İstanbul’da bulunan, Rusya ve Orta Asya ülkelerine  kargo hizmeti veren şirketler müşterilere daha iyi hizmet verebileri için yapılmıştır. Portal kargo ile kargonuz nerede olduğunu  kolayca oğrenebilirsiniz. Kargo şirketleri kendi işlerini kolayca yönetebilirler. Şirketler için aşağidaki özellikleri sunmaktayız!</p>
                    <ul class="list-group">
                        <li class="list-group-item text-info">Her Gönderi İçin Özel Kargo Takip No</li>
                        <li class="list-group-item text-info">Kargo Telegram Bilgilendirmesi</li>
                        <li class="list-group-item text-success">Dinamik Invoice</li>
                        <li class="list-group-item text-danger">Manafes Hazırlama - Excel</li>
                        <li class="list-group-item text-primary">Baza Hazırlama - Excel</li>
                    </ul>
                </div>
            </div>
        </div>
        
        
        @include('about')
        
    </div>
</div>

<div class="site-section" id="about-system">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <div class="block-heading-1">
                    <h2>Sistem Görselleri</h2>
                    <p>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <a target="_blank" href="{{asset('web/images/1.jpg')}}">
            <img class="img-fluid " src="{{asset('web/images/1.jpg')}}">
            </a>
        </div>
        <hr>
        <div class="col-md-6">
            <a target="_blank" href="{{asset('web/images/2.jpg')}}">
            <img class="img-fluid " src="{{asset('web/images/2.jpg')}}">
            </a>
        </div>
        <hr>
        <div class="col-md-6">
            <a target="_blank" href="{{asset('web/images/3.jpg')}}">
            <img class="img-fluid " src="{{asset('web/images/3.jpg')}}">
            </a>
        </div>

        <div class="col-md-6">
            <a target="_blank" href="{{asset('web/images/4.jpg')}}">
            <img class="img-fluid " src="{{asset('web/images/4.jpg')}}">
            </a>
        </div>

        
         </div>
    </div>
</div>


<div class="site-section bg-light" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" >
                <div class="block-heading-1">
                    
                    <h2>İletişim</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-5" >
                <form action="#contact" method="get">
                    <div class="form-group row">
                        <div class="col-md-6 mb-4 mb-lg-0">
                            <input type="text" class="form-control" placeholder="Ad" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Soyad" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Email address" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea name="" id="" class="form-control" placeholder="Mesaj" cols="30" rows="10"></textarea required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mr-auto">
                            <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Gönder">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 ml-auto" >
                <div class="bg-white p-3 p-md-5">
                    <h3 class="text-black mb-4">Hızlı İletişim</h3>
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
            </div>
        </div>
    </div>
</div>
@endsection