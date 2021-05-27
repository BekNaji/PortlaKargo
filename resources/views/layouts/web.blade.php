<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" CONTENT="Company: Zolotoy Express">
    <title>Zolotoy Kargo</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/bootstrap.min.css">
    <!-- Font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/font-awesome.min.css">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/slicknav.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/owl.theme.css">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/main.css">
    <!-- Extras Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/extras.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('zolotoy') }}/css/responsive.css">

    <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/sweetalert2/sweetalert2.min.css">

</head>

<body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar indigo">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar"
                        aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="icon-menu"></span>
                        <span class="icon-menu"></span>
                        <span class="icon-menu"></span>
                    </button>
                    <a href="/" class="navbar-brand"><img src="{{ asset('zolotoy') }}/img/logo.png" alt=""
                            style="width: 35%!important;">
                        <span style="font-size: 25px; color: rgb(204 162 101); display: inline-block;position: absolute;top: 30px;
              left: 70px;">Zolotoy Express</span>
                    </a>

                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                        <li class="nav-item active">
                            <a class="nav-link" href="#sliders">
                                Boshsahifa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">
                                Biz haqimizda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">
                                Hizmatlar
                            </a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">
                                Aloqa
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Mobile Menu Start -->
            <ul class="mobile-menu navbar-nav">
                <li>
                    <a class="page-scroll" href="#sliders">
                        Boshsahifa
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">
                        Biz haqimizda
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">
                        Hizmatlar
                    </a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">
                        Aloqa
                    </a>
                </li>
            </ul>
            <!-- Mobile Menu End -->

        </nav>
        <!-- sliders -->
        <div id="sliders">
            <div class="full-width">
                <!-- light slider -->
                <div id="light-slider" class="carousel slide">
                    <div id="carousel-area">
                        <div id="carousel-slider" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img src="{{ asset('zolotoy') }}/img/slider/bg-11.jpg" alt=""
                                        style="filter: brightness(0.3);">
                                    <div class="carousel-caption">
                                        <h3 class="slide-title animated fadeInDown"><span
                                                style="color: rgb(204 162 101);">{{$data['header']->title ?? ''}}</span><br>
                                            {{$data['header']->description}}</h3>
                                        <form action="{{route('search')}}" method="GET" class="mt-4">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                    <input name="key" type="text" class="form-control"
                                                        placeholder="Kargo raqamini yozing">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-common btn-form-submit"
                                                        type="submit">Qidirish</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End sliders -->
    </header>
    <!-- Navbar End -->
    @yield('content')

<!-- Footer Section -->
<footer class="footer">
    <!-- Copyright -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="copyright-text">All rights reserved © {{ date('Y',strtotime('now'))}} Zolotoy Express
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright  End-->

    </footer>
    <!-- Footer Section End-->

    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
        <i class="fa fa-arrow-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('zolotoy') }}/js/jquery-min.js"></script>
    <script src="{{ asset('zolotoy') }}/js/popper.min.js"></script>
    <script src="{{ asset('zolotoy') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('zolotoy') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('zolotoy') }}/js/jquery.mixitup.js"></script>
    <script src="{{ asset('zolotoy') }}/js/jquery.countTo.js"></script>
    <script src="{{ asset('zolotoy') }}/js/jquery.nav.js"></script>
    <script src="{{ asset('zolotoy') }}/js/scrolling-nav.js"></script>
    <script src="{{ asset('zolotoy') }}/js/jquery.easing.min.js"></script>
    <script src="{{ asset('zolotoy') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('zolotoy') }}/js/form-validator.min.js"></script>
    <script src="{{ asset('zolotoy') }}/js/contact-form-script.js"></script>
    <script src="{{ asset('zolotoy') }}/js/main.js"></script> 
    <script src="{{ asset('admin') }}/assets/js/extensions/sweetalert2.js"></script>
    <script src="{{ asset('admin') }}/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        @if(session('warning'))
            Swal.fire({
                icon: "warning",
                title: "{{session('warning')}}"
            });
        @endif
        </script>
    @yield('js')  
    
</body>

</html>
