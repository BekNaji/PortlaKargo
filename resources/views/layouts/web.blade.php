<html>
    <head>
        <title>Uzbek Kargo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="colorlib.com">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="{{ asset('assets') }}/css/toastr.min.css" rel="stylesheet" />
        <style type="text/css">
        body {
        background-image: url(https://images2.alphacoders.com/279/thumb-1920-279630.jpg);
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
        }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="{{url('/')}}">Uzbek Kargo</a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item {{request()->is('/')?'active':''}}">
                        <a class="nav-link" href="{{url('/')}}">{{__('home.home')}}</a>
                    </li>
                    <li class="nav-item {{request()->is('price')?'active':''}}">
                        <a class="nav-link" href="{{url('price')}}">{{__('home.price')}}</a>
                    </li>
                    <li class="nav-item {{request()->is('about')?'active':''}}">
                        <a class="nav-link" href="{{url('about')}}">{{__('home.about_us')}}</a>
                    </li>
                    <li class="nav-item {{request()->is('contact')?'active':''}}">
                        <a class="nav-link" href="{{url('contact')}}">{{__('home.contact')}}</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.index')}}">{{__('home.admin_panel')}}</a>
                    </li>
                    @else
                    <li class="nav-item  {{request()->is('login')?'active':''}}">
                        <a class="nav-link" href="{{route('login')}}">{{__('home.login')}}</a>
                    </li>
                    @endauth
                    <li class="nav-item  {{request()->is('register')?'active':''}}">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('home.register') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class=" nav-link dropdown-toggle" data-toggle="dropdown" href="#">{{ __('home.language') }}
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link text-dark" href="{{ url('locale/en') }}">English</a></li>
                                <li><a class="nav-link text-dark" href="{{ url('locale/tr') }}">Türkçe</a></li>
                                <li><a class="nav-link text-dark" href="{{ url('locale/uz') }}">O'zbekcha</a></li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                @yield('content')
            </div>
            <script src="{{ asset('assets') }}/js/toastr.min.js"></script>
            <script type="text/javascript">
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
            </script>
            <script type="text/javascript">
            @if(session('warning'))
            toastr.warning("{{session('warning')}}");
            @endif
            </script>
            </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
        </html>