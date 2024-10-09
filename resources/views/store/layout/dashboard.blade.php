<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('meta')
	<!--favicon-->
	<link rel="icon" href="{{asset("assetDashboard/" . "assets/images/favicon-32x32.png")}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset("assetDashboard/" . "assets/plugins/simplebar/css/simplebar.css")}}" rel="stylesheet" />
	<link href="{{asset("assetDashboard/" . "assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css")}}" rel="stylesheet" />
	<link href="{{asset("assetDashboard/" . "assets/plugins/metismenu/css/metisMenu.min.css")}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset("assetDashboard/" . "assets/css/pace.min.css")}}" rel="stylesheet" />
	<script src="{{asset("assetDashboard/" . "assets/js/pace.min.js")}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset("assetDashboard/" . "assets/css/bootstrap.min.css")}}" rel="stylesheet">
	<link href="{{asset("assetDashboard/" . "assets/css/app.css")}}" rel="stylesheet">
	<link href="{{asset("assetDashboard/" . "assets/css/icons.css")}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset("assetDashboard/" . "assets/css/dark-theme.css")}}" />
	<link rel="stylesheet" href="{{asset("assetDashboard/" . "assets/css/semi-dark.css")}}" />
	<link rel="stylesheet" href="{{asset("assetDashboard/" . "assets/css/header-colors.css")}}" />
    @stack('styles')
	<title> @yield('pagetitle', 'Rukada - Responsive Bootstrap 5 Admin Template')</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset("assetDashboard/" . "assets/images/logo-icon.png")}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Rukada</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->

                @include('store.partial.navigation')
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
            @include('store.partial.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">@yield('title')</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
                                @section('breadcrumb')
                                    <li class="breadcrumb-item">
                                        <a href="{{route('vendor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                @show
							</ol>
						</nav>
					</div>


                {{--setting button --}}
					<div class="ms-auto">
                        @yield('addbutton')
					</div>
                {{--end setting button --}}
				</div>
				<!--end breadcrumb-->
                <hr>


                <div class="card">
					@yield('content')
                </div>


			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
        @include('store.partial.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
        @include("store.partial.switcher")
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset("assetDashboard/" . "assets/js/bootstrap.bundle.min.js")}}"></script>
	<!--plugins-->
	<script src="{{asset("assetDashboard/" . "assets/js/jquery.min.js")}}"></script>
	<script src="{{asset("assetDashboard/" . "assets/plugins/simplebar/js/simplebar.min.js")}}"></script>
	<script src="{{asset("assetDashboard/" . "assets/plugins/metismenu/js/metisMenu.min.js")}}"></script>
	<script src="{{asset("assetDashboard/" . "assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js")}}"></script>
	<!--app JS-->
	<script src="{{asset("assetDashboard/" . "assets/js/app.js")}}"></script>

    @stack('scripts')
</body>

</html>
