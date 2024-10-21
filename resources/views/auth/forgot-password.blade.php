{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
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
                                <li><a href="{{ route('login') }}">Forget Password</a></li>
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
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle" aria-hidden="true"></i></span>
                        <h4>forget password ?</h4>
                        <p>enter the email address to register with <span>e-shop</span></p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope" aria-hidden="true"></i>
                                    <input placeholder="Your Email" id="email" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{route('login')}}">go to login</a>
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

