<!doctype html>
<html lang="en">

  <head>
    <title>Cargo &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('web')}}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{asset('web')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('web')}}/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{asset('web')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('web')}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('web')}}/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="{{asset('web')}}/css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('web')}}/css/style.css">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  

    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <!-- header up -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span class="d-none d-md-inline-block">bekturk333@gmail.com</span></a>
              <span class="mx-md-2 d-inline-block"></span>
              <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">+905550156185</span></a>


            <!--   <div class="float-right">

                <a href="#" class=""><span class="mr-2  icon-twitter"></span> <span class="d-none d-md-inline-block">Twitter</span></a>
                <span class="mx-md-2 d-inline-block"></span>
                <a href="#" class=""><span class="mr-2  icon-facebook"></span> <span class="d-none d-md-inline-block">Facebook</span></a>

              </div> -->

            </div>

          </div>

        </div>
      </div>
      <!-- header up finished -->

      <!-- header menu -->
      <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">


            <div class="site-logo">
              <a href="{{url('/')}}" class="text-black"><span class="text-primary">Portal Kargo</a>
            </div>

            <div class="col-12">
              <nav class="site-navigation text-right ml-auto " role="navigation">

                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                  <li><a href="{{url('/')}}#home-section" class="nav-link">Anasyfa</a></li>
                  <li><a href="{{url('/')}}#about" class="nav-link">Hakkımızda</a></li>
                  <li><a href="{{url('/')}}#about-system" class="nav-link">Sistem hakkında</a></li>
                  <li><a href="{{url('/')}}#contact" class="nav-link">İletişim</a></li>
                  <li><a href="{{route('login')}}" class="nav-link">Giriş</a></li>
                  <li><a href="{{route('register')}}" class="nav-link">Kayit</a></li>
                </ul>
              </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>
        </div>

      </header>
      <!-- header menu finished -->
      @yield('content')

        
    </div>






    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-7">
                <h2 class="footer-heading mb-4">About Us</h2>
                <p>101 Kargo hakkında
                Bu web site Türkiyede özellikle İstanbul’da bulunan, Orta Asya ülkelerine  kargo hizmeti veren şirketler için tasarlanmıştır. Kargo Takip sistemi ile gönderileri kolayca takip edebilirsiniz.</p>
              </div>
              <div class="col-md-4 ml-auto">
                <h2 class="footer-heading mb-4">Features</h2>
                <ul class="list-unstyled">
                   <li><a href="{{url('/')}}#home-section" >Home</a></li>
                  <li><a href="{{url('/')}}#about" >Hakkımızda</a></li>
                  <li><a href="{{url('/')}}#about-system" >Sistem hakkında</a></li>
                  <li><a href="{{url('/')}}#contact" >İletişim</a></li>
                  <li><a href="{{route('login')}}">Giriş</a></li>
                  <li><a href="{{route('register')}}">Kayit</a></li>
                </ul>
              </div>

            </div>
          </div>
          <div class="col-md-4 ml-auto">

            <div class="mb-5">
              <h2 class="footer-heading mb-4">Subscribe to Newsletter</h2>
              <form action="#" method="post" class="footer-suscribe-form">
                <div class="input-group mb-3">
                  <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary text-white" type="button" id="button-addon2">Subscribe</button>
                  </div>
                </div>
            </div>


            <h2 class="footer-heading mb-4">Follow Us</h2>
            <a href="#about-section" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p class="copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>

        </div>
      </div>
    </footer>

    </div>

    <script src="{{asset('web')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('web')}}/js/popper.min.js"></script>
    <script src="{{asset('web')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('web')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('web')}}/js/jquery.sticky.js"></script>
    <script src="{{asset('web')}}/js/jquery.waypoints.min.js"></script>
    <script src="{{asset('web')}}/js/jquery.animateNumber.min.js"></script>
    <script src="{{asset('web')}}/js/jquery.fancybox.min.js"></script>
    <script src="{{asset('web')}}/js/jquery.easing.1.3.js"></script>
    <script src="{{asset('web')}}/js/aos.js"></script>

    <script src="{{asset('web')}}/js/main.js"></script>


  </body>

</html>
