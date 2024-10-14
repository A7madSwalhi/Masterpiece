<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<title> Profile</title>
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
                {{-- @include('Admin.partial.navigation') --}}
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
					<div class="breadcrumb-title pe-3">Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">

                                    <li class="breadcrumb-item">
                                        <a href="{{route('vendor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Profile
                                    </li>

							</ol>
						</nav>
					</div>


                {{--setting button --}}

                {{--end setting button --}}
				</div>
				<!--end breadcrumb-->
                <hr>
                <div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="{{ $profile->image_url }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
                                                <h4>{{ auth('vendor')->user()->shop_name  }}</h4>
												<p>{{ ($profile->first_name . " " . $profile->last_name)  }}</p>
												<p class="text-secondary mb-1">Vendor</p>
											</div>
										</div>
                                    </div>
								</div>
							</div>


							<div class="col-lg-8">
								<div class="card">
                                    <form action="{{ route("vendor.profile.update",auth('vendor')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="card-body">

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6>
                                                        <x-form.label  id="shop_name" >Shop Name</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="shop_name" id="shop_name" placeholder="Enter First Name" :required="true" :value="auth('vendor')->user()->shop_name"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6>
                                                        <x-form.label  id="first_name" >First Name</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="first_name" id="first_name" placeholder="Enter First Name" :required="true" :value="$profile->first_name"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6>
                                                        <x-form.label  id="last_name" >Last Name</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" :required="true" :value="$profile->last_name"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="email" >Email</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="email" id="email" placeholder="Enter email Name"  :value="auth('vendor')->user()->email" disabled/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="phone" >Phone</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="phone" id="phone" placeholder="Enter Phone "  :value="$profile->phone"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="gender" >Gender</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.select name="gender" id="gender" :options="['male' => 'Male' ,'female' => 'Female']" :selected="$profile->gender"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="birthday" >Birthday</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="date" name="birthday" id="birthday"  :value="$profile->birthday"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="country" >Country</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.select name="country" id="country" first="Country" :options="$countries" :selected="$profile->country"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="city" >City</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="city" id="city" placeholder="Enter City "  :value="$profile->city"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="city" >State</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="state" id="state" placeholder="Enter State "  :value="$profile->state"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="street_address" >Street Address</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="street_address" id="street_address" placeholder="Enter Atreet Address "  :value="$profile->street_address"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="postal_code" >Postal Code</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="text" name="postal_code" id="postal_code" placeholder="Enter Postal Code "  :value="$profile->postal_code"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label  id="locale" >Language</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.select name="locale" id="locale" first="Language" :options="$locales" :selected="$profile->locale"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">
                                                        <x-form.label id="image-form" class="col-form-label">Image</x-form.label>
                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <x-form.input type="file" name="image" id="image-form"/>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">

                                                    </h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <img id="showImage" src="{{$profile->image_url}}" width="110" alt="">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <button class="btn btn-primary px-4" type="submit">Save Changes</button>
                                                </div>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image-form').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <x-flashtoaster />


</body>

</html>
