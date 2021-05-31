@extends('layouts.web')
@section('content')

<!-- Header Area wrapper End -->

<!-- About Section Start -->
<div id="about" class="section-padding">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="about block text-center">
                <img src="{{asset($data['about']->image ?? '')}}" alt="">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="about block text-center">
                <img src="img/about/img2.png" alt="">
                <h5><a href="#">Biz Haqimizda</a></h5>
                {!! $data['about']->description ?? ''!!}
            </div>
        </div>
    </div>
</div>
</div>
<!-- About Section End -->

<!-- Services Section Start -->
<section id="services" class="section-padding">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title wow fadeInDown animated" data-wow-delay="0.3s">Hizmatlar</h2>
        </div>
    </div>
    <div class="row">
        <!-- Start Service Icon 1 -->
        @forelse ($data['services'] as $item)
        <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="service-box">
                <div class="service-content">
                    <h4><a href="#">{{$item->title ?? ''}}</a></h4>
                    <p>{{$item->description ?? ''}}</p>
                </div>
            </div>
        </div>
        @empty 
        <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="service-box">
                <div class="service-content">
                    <h4><a href="#">Servis Ismi</a></h4>
                    <p>Servis izih</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
</section>
<!-- Services Section End -->

<!-- facts Section Start -->
<div id="counter" style="background-image: url('{{ asset('zolotoy') }}/img/services-bg.png')">
<div class="container">
    <div class="row count-to-sec">
        <div class="col-lg-3 col-md-6 col-xs-12 count-one">
            <span class="icon"><i class="fa fa-download"> </i></span>
            <h3 class="timer count-value" data-to="{{count($data['address'])}}" data-speed="1000">
                {{count($data['address'])}}
            </h3>
            <hr class="width25-divider">
            <small class="count-title">Filialar soni</small>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12 count-one">
            <span class="icon"><i class="fa fa-user"> </i></span>
            <h3 class="timer count-value" data-to="{{$data['customer'] ?? 100}}" data-speed="1000">{{$data['customer'] ?? 100}}</h3>
            <hr class="width25-divider">
            <small class="count-title">Mijozlar soni</small>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12 count-one">
            <span class="icon"><i class="fa fa-desktop"> </i></span>
            <h3 class="timer count-value" data-to="{{$data['cargo'] ?? 123}}" data-speed="1000">{{$data['cargo'] ?? 211}}</h3>
            <hr class="width25-divider">
            <small class="count-title">Shu kungacha yuborilgan Kargolar soni</small>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12 count-one">
            <span class="icon"><i class="fa fa-coffee"> </i></span>
            <h3 class="timer count-value" data-to="{{$data['customer'] ?? '100' - rand(1,10)}}" data-speed="1000">{{$data['customer'] ?? '100' - rand(1,10)}}</h3>
            <hr class="width25-divider">
            <small class="count-title">Mamnun mijozlar soni</small>
        </div>
    </div>
</div>
</div>
<!-- facts Section End -->


<!-- Pricing section Start -->
<section id="contact" class="section-padding">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-12">
            <h2 class="title-head wow fadeInDown animated" data-wow-delay="0.3s">Ko'p so'ralgan savollar!
            </h2>
            <div id="accordion">
                @forelse ($data['faqs'] as $key => $item)
                <div class="card" style="margin-bottom: 2px!important">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapse{{ $key }}">
                            {{$item->title ?? ''}}
                        </a>
                    </div>
                    <div id="collapse{{ $key }}" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            {{$item->description ?? ''}}
                        </div>
                    </div>
                </div>
                @empty
                <div class="card" style="margin-bottom: 2px!important">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapse{{ $key }}">
                           Kargo 
                        </a>
                    </div>
                    <div id="collapse{{ $key }}" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           Kargo Hizmati
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <h3 class="title-head text-left">Biz bilan aloqaga chiqing</h3>
            
            <div class="social-footer">
                @isset($data['option'])
                <ul>
                    @if ($data['option']->socials->facebook)
                    <li><a href="{{$data['option']->socials->facebook}}"><i class="fa fa-facebook icon-round"></i> Facebook</a></li>
                    @endif
                    @if ($data['option']->socials->twitter)
                    <li><a href="{{$data['option']->socials->twitter}}"><i class="fa fa-twitter icon-round"></i> Twitter</a></li>
                    @endif
                    @if ($data['option']->socials->telegram)
                    <li><a href="{{$data['option']->socials->telegram}}"><i class="fa fa-telegram icon-round"></i>Telegram</a></li>
                    @endif
                    @if ($data['option']->socials->whatsapp)
                    <li><a href="{{$data['option']->socials->whatsapp}}"><i class="fa fa-whatsapp icon-round"></i>Whatsapp</a></li>
                    @endif
                    @if ($data['option']->socials->youtube)
                    <li><a href="{{$data['option']->socials->youtube}}"><i class="fa fa-youtube icon-round"></i>Youtube</a></li>
                    @endif
                </ul>  
                @endisset
            </div>
        </div>
    </div>
</div>
</section>
<!-- Pricing Table Section End -->

<!-- About Section Start -->
<div id="" class="section-padding">
<div class="container">
    <div class="row">
        @forelse ($data['address'] as $item)
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="justify-content-center d-flex">
                <p>
                    <ul>
                        <li><b>{{$item->title ?? ''}}</b></li>
                        <li>{{$item->description ?? ''}}</li>
                    </ul>
                </p>
            </div>
        </div>
        @empty 
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="justify-content-center d-flex">
                <p>
                    <ul>
                        <li><b>Zolotoy Express</b></li>
                        <li>Aksaray Istanbul</li>
                    </ul>
                </p>
            </div>
        </div>
        @endforelse
    </div>
</div>
</div>
<!-- About Section End -->
@endsection