<x-front-layout>

    <x:$breadcrumb>
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>forget password</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a href="#">Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>


    <!--============================
        CHECK OUT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">

            <form class="wsus__checkout_form" method="POST" action="{{ route('checkout') }}">
                @csrf

                <div class="row">

                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details </h5>
                            <div class="row">

                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][first_name]" placeholder="First Name" value="{{ @old('addr[billing][first_name]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][first_name]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][last_name]" placeholder="Last Name" value="{{ @old('addr[billing][last_name]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][last_name]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <select class="select_2" name="addr[billing][country]">
                                                                        <option value="">Country</option>
                                                                        @foreach ($countries as $key => $country )
                                                                            <option value="{{ $key }}">{{ $country }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <x-form.validation-feedback name="addr[billing][country]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][street_address]" placeholder="Street Address *" value="{{ @old('addr[billing][street_address]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][street_address]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][apartment]" value="{{ @old('addr[billing][apartment]') }}"
                                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                                    <x-form.validation-feedback name="addr[billing][apartment]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][city]" placeholder="City *" value="{{ @old('addr[billing][city]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][city]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][state]" placeholder="State *" value="{{ @old('addr[billing][state]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][state]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][postal_code]" placeholder="Zip *" value="{{ @old('addr[billing][postal_code]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][postal_code]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[billing][phone_number]" placeholder="Phone *" value="{{ @old('addr[billing][phone_number]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][phone_number]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="email" name="addr[billing][email]"  placeholder="Email *" value="{{ @old('addr[billing][email]') }}">
                                                                    <x-form.validation-feedback name="addr[billing][email]" />
                                                                </div>
                                                            </div>

                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="accordion checkout_accordian" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    <div class="wsus__check_single_form">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="same" value="1"
                                                                id="flexCheckDefault" >
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Same as shipping address
                                                            </label>
                                                        </div>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-0">
                                                    <div class="wsus__check_form p-0" style="box-shadow: none;">

                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][first_name]" placeholder="First Name" value="{{ @old('addr[shipping][first_name]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][first_name]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][last_name]" placeholder="Last Name" value="{{ @old('addr[shipping][last_name]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][last_name]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <select class="select_2" name="addr[shipping][country]">
                                                                        <option value="">Country</option>
                                                                        @foreach ($countries as $key => $country )
                                                                            <option value="{{ $key }}">{{ $country }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <x-form.validation-feedback name="addr[shipping][country]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][street_address]" placeholder="Street Address *" value="{{ @old('addr[shipping][street_address]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][street_address]" />
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][apartment]" value="{{ @old('addr[shipping][apartment]') }}"
                                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                                    <x-form.validation-feedback name="addr[shipping][apartment]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][city]" placeholder="City *" value="{{ @old('addr[shipping][city]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][city]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][state]" placeholder="State *" value="{{ @old('addr[shipping][state]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][state]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][postal_code]" placeholder="Zip *" value="{{ @old('addr[shipping][postal_code]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][postal_code]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="text" name="addr[shipping][phone_number]" placeholder="Phone *" value="{{ @old('addr[shipping][phone_number]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][phone_number]" />
                                                                </div>
                                                            </div>



                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="wsus__check_single_form">
                                                                    <input type="email" name="addr[shipping][email]"  placeholder="Email *" value="{{ @old('addr[shipping][email]') }}">
                                                                    <x-form.validation-feedback name="addr[shipping][email]" />
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">Checkout</p>
                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{Currency::format($cart->total())  }}</span></p>
                                <p>shipping fee: <span>{{ Currency::format(0.00)}} </span></p>
                                <p>discount: <span>{{Currency::format($cart->discount())}}</span></p>
                                <p><b>total:</b> <span><b>{{Currency::format( $cart->total() - $cart->discount() )  }}</b></span></p>
                            </div>
                            <button  type="submit" class="common_btn">Place Order</button>
                        </div>
                    </div>


                </div>
            </form>


        </div>
    </section>

    <!--============================
        CHECK OUT PAGE END
    ==============================-->


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('flexCheckDefault');
    console.log(checkbox); // Debug the checkbox element

    const billingInputs = {
        first_name: document.querySelector('input[name="addr[billing][first_name]"]'),
        last_name: document.querySelector('input[name="addr[billing][last_name]"]'),
        country: document.querySelector('select[name="addr[billing][country]"]'),
        street_address: document.querySelector('input[name="addr[billing][street_address]"]'),
        apartment: document.querySelector('input[name="addr[billing][apartment]"]'),
        city: document.querySelector('input[name="addr[billing][city]"]'),
        state: document.querySelector('input[name="addr[billing][state]"]'),
        postal_code: document.querySelector('input[name="addr[billing][postal_code]"]'),
        phone_number: document.querySelector('input[name="addr[billing][phone_number]"]'),
        email: document.querySelector('input[name="addr[billing][email]"]')
    };

    const shippingInputs = {
        first_name: document.querySelector('input[name="addr[shipping][first_name]"]'),
        last_name: document.querySelector('input[name="addr[shipping][last_name]"]'),
        country: document.querySelector('select[name="addr[shipping][country]"]'),
        street_address: document.querySelector('input[name="addr[shipping][street_address]"]'),
        apartment: document.querySelector('input[name="addr[shipping][apartment]"]'),
        city: document.querySelector('input[name="addr[shipping][city]"]'),
        state: document.querySelector('input[name="addr[shipping][state]"]'),
        postal_code: document.querySelector('input[name="addr[shipping][postal_code]"]'),
        phone_number: document.querySelector('input[name="addr[shipping][phone_number]"]'),
        email: document.querySelector('input[name="addr[shipping][email]"]')
    };

    // Log the billing inputs to check if they are being selected correctly
    console.log('Billing Inputs:', billingInputs);

    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            console.log("Checkbox is checked");

            // Copy values from billing to shipping inputs
            for (const key in billingInputs) {
                if (billingInputs.hasOwnProperty(key)) {
                    const billingValue = billingInputs[key].value || ''; // Get value or fallback to empty string
                    shippingInputs[key].value = billingValue;

                    // Log to check the value copying process
                    console.log(`Copying ${key}:`, billingValue, ' to shipping:', shippingInputs[key].value);
                }
            }
        } else {
            console.log("Checkbox is unchecked");

            // Clear shipping inputs if checkbox is unchecked
            for (const key in shippingInputs) {
                if (shippingInputs.hasOwnProperty(key)) {
                    shippingInputs[key].value = ''; // Clear value

                    // Log clearing process
                    console.log(`Clearing ${key}:`, shippingInputs[key].value);
                }
            }
        }
    });
});
        </script>
    @endpush









</x-front-layout>
