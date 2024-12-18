{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}







<x-front-layout>

    <x:$breadcrumb>
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>Product Details</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('login') }}">Login / Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>

    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill" data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes" aria-selected="true">login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill" data-bs-target="#pills-profiles" type="button" role="tab" aria-controls="pills-profiles" aria-selected="true">signup</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel" aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('login') }}">

                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                                            <input type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}" >
                                        </div>


                                        <div class="wsus__login_input">
                                            <i class="fas fa-key" aria-hidden="true"></i>
                                            <input type="password" placeholder="Password" name="password" id="password">
                                        </div>


                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                                    me</label>
                                            </div>


                                            <a class="forget_p" href="{{ route('password.request') }}">forget password ?</a>
                                        </div>
                                        <button class="common_btn" type="submit">login</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel" aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}" >

                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                                            <input type="text" placeholder="Name" id="name" name="name" value="{{ old('name') }}" required>
                                        </div>


                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope" aria-hidden="true"></i>
                                            <input placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required>
                                        </div>


                                        <div class="wsus__login_input">
                                            <i class="fas fa-key" aria-hidden="true"></i>
                                            <input placeholder="Password" id="password" type="password" name="password" required>
                                        </div>


                                        <div class="wsus__login_input">
                                            <i class="fas fa-key" aria-hidden="true"></i>
                                            <input placeholder="Confirm Password" name="password_confirmation" type="password" id="password_confirmation" required>
                                        </div>

                                        <button class="common_btn mt-4" type="submit">signup</button>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


   @push('scripts')

        @if ($errors->any())
            <script>
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": 0,
                    "extendedTimeOut": 0,
                    "onclick": function() { toastr.clear(); }
                };
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach

            </script>
        @endif

   @endpush



</x-front-layout>

