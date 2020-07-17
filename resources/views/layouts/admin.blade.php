<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>
		@if(View::hasSection('title'))
		@yield('title')
		@else
		{{ config('app.name') }}
		@endif
		</title>
		<link href="{{ asset('assets') }}/css/styles.css" rel="stylesheet" />
		<link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"  />
		<link href="{{ asset('assets') }}/css/bootstrap-select.min.css"/>
		<link href="{{ asset('assets') }}/css/dataTables.bootstrap4.min.css" crossorigin="anonymous" />
		<script src="{{ asset('assets') }}/js/all.min.js" type="text/javascript"></script>
		<link href="{{ asset('assets') }}/css/dataTables.min.css" rel="stylesheet" />
		<link href="{{ asset('assets') }}/css/toastr.min.css" rel="stylesheet" />
	</head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
			<a class="navbar-brand" href="{{route('home')}}">
				{{Auth::user()->company->name ?? ''}}
			</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
			>
			<!-- Navbar Search-->
			<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			</form>
			<!-- Navbar-->
			<ul class="navbar-nav ml-auto ml-md-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="{{route('profile.index')}}">Kullanıcı Ayarları</a>
						<a class="dropdown-item" href="{{route('settings.index')}}">Genel Ayarlar</a>
						<div class="dropdown-divider"></div>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" >
							@csrf
							<button class="dropdown-item" type="submit" >Çıkış</button>
						</form>
					</div>
				</li>
			</ul>
		</nav>
		<div id="layoutSidenav">
			<div id="layoutSidenav_nav">
				<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
					<div class="sb-sidenav-menu">
						<div class="nav">
							<!-- <div class="sb-sidenav-menu-heading">Core</div> -->
							<a class="nav-link
								{{request()->is('dashboard/index') || request()->is('dashboard/index/*') ?'active' : ''}} "
								href="{{route('dashboard.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
							Anasayfa</a
							>
							@if(Auth::user()->role == 'admin' || Auth::user()->role == 'user')
							<a class="nav-link
								{{request()->is('dashboard/cargo/*')  ?'active' : ''}} "
								href="{{route('cargo.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
							Kargo</a
							>
							<a class="nav-link
								{{request()->is('dashboard/customer/*')  ?'active' : ''}} "
								href="{{route('customer.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-arrow-right"></i></div>
							Göndericiler</a
							>
							<a class="nav-link
								{{request()->is('dashboard/receiver/*')  ?'active' : ''}} "
								href="{{route('receiver.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-arrow-right"></i></div>
							Alıcılar</a
							>
							@endif
							<a class="nav-link
								{{request()->is('dashboard/profile/*')  ?'active' : ''}} "
								href="{{route('profile.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
							Profil ayarları</a
							>
							@if(Auth::user()->role == 'admin' || Auth::user()->role == 'root')
							<a class="nav-link
								{{request()->is('dashboard/user/*')  ?'active' : ''}} "
								href="{{route('user.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
							Kullanıcılar</a
							>
							
							@endif
							@if(Auth::user()->role == 'admin')
							<a class="nav-link
								{{request()->is('dashboard/status/cargo*')  ?'active' : ''}} "
								href="{{route('status.cargo.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-hashtag"></i></div>
							Kargo Status Ayarları</a
							>
							<a class="nav-link
								{{request()->is('dashboard/settings/*')  ?'active' : ''}} "
								href="{{route('settings.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
							Genel Ayarlar</a
							>
							@endif
							@if(Auth::user()->role == 'root')
							<a class="nav-link
								{{request()->is('dashboard/company/*')  ?'active' : ''}} "
								href="{{route('company.index')}}"
								><div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
							Şirketler</a
							>
							@endif
						</div>
					</div>
				</nav>
			</div>
			<div id="layoutSidenav_content">
				<main>
					<div class="container-fluid" id="body">
						@yield('content')
					</div>
				</main>
				<footer class="py-4 bg-light mt-auto">
					<div class="container-fluid">
						<div class="d-flex align-items-center justify-content-between small">
							<div class="text-muted">Copyright &copy; Bekzod Najmiddinov 2020</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="{{ asset('assets') }}/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
		<script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="{{ asset('assets') }}/js/scripts.js" crossorigin="anonymous"></script>
		<script src="{{ asset('assets') }}/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
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
		@yield('js')
		<script type="text/javascript">
		$('#dataTable').DataTable();
		$('#body').hide();
		$('#body').fadeIn(1000);
		@if(session('success'))
		toastr.success("{{session('success')}}");
		@endif
		</script>
	</body>
</html>