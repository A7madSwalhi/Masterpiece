<x-front-layout>

    <x:$breadcrumb>
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>Order Tracking</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="#">Order Tracking</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>


    <section id="wsus__login_register">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__track_header">
                            <div class="wsus__track_header_text">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        @if ($order->status == 'pending')
                                            <div class="wsus__track_header_single">
                                                <h5>Order Date:</h5>
                                                <p>{{ $order->created_at }}</p>
                                            </div>
                                        @elseif ($order->status == 'confirmed')
                                            <div class="wsus__track_header_single">
                                                <h5>Confirmed Date:</h5>
                                                <p>{{ $order->confirmed_date }}</p>
                                            </div>
                                        @elseif ($order->status == 'processing')
                                            <div class="wsus__track_header_single">
                                                <h5>processing Date:</h5>
                                                <p>{{ $order->processing_date }}</p>
                                            </div>
                                        @elseif ($order->status == 'delivering')
                                            <div class="wsus__track_header_single">
                                                <h5>delivering Date:</h5>
                                                <p>{{ $order->shipped_date }}</p>
                                            </div>
                                        @elseif ($order->status == 'completed')
                                            <div class="wsus__track_header_single">
                                                <h5>delived Date:</h5>
                                                <p>{{ $order->delivered_date }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>shopping amount:</h5>
                                            <p>{{ Currency::format($order->total - $order->discount + $order->shipping + $order->tax ) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>status:</h5>
                                            <p>{{ $order->status }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single border_none">
                                            <h5>Invoice No:</h5>
                                            <p>{{ $order->invoice_no  }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <ul class="progtrckr" data-progtrckr-steps="5">
                            <li class="progtrckr_done icon_one @if ($order->status == 'pending' ||
                                                                    $order->status == 'confirmed' ||
                                                                    $order->status == 'processing' ||
                                                                    $order->status == 'delivering' ||
                                                                    $order->status == 'completed')
                                    check_mark
                            @endif">Order pending</li>
                            <li class="progtrckr_done icon_four @if ($order->status == 'confirmed' ||
                                                                    $order->status == 'processing' ||
                                                                    $order->status == 'delivering' ||
                                                                    $order->status == 'completed')
                                    check_mark
                            @endif">Order Confirmed</li>
                            <li class="progtrckr_done icon_three @if ($order->status == 'processing' ||
                                                                    $order->status == 'delivering' ||
                                                                    $order->status == 'completed')
                                    check_mark
                            @endif">order Processing</li>
                            <li class="progtrckr_done icon_two @if (
                                                                    $order->status == 'delivering' ||
                                                                    $order->status == 'completed')
                                    check_mark
                            @endif">on the way</li>
                            <li class="progtrckr_done icon_five @if (
                                                                    $order->status == 'completed')
                                    check_mark
                            @endif">order delivered</li>
                        </ul>
                    </div>

                    <div class="col-xl-12">
                        <a href="{{ route('track.index') }}" class="common_btn"><i class="fas fa-chevron-left" aria-hidden="true"></i> track another order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script>
            const stars = document.querySelectorAll('.rating i');
            const ratingValueInput = document.getElementById('ratingValue');
            let selectedRating = 0;

            stars.forEach((star) => {
                // Handle hover effect
                star.addEventListener('mouseover', () => {
                    resetStars();
                    highlightStars(star.getAttribute('data-value'));
                });

                star.addEventListener('mouseout', () => {
                    resetStars();
                    if (selectedRating) highlightStars(selectedRating);
                });

                // Handle click event
                star.addEventListener('click', () => {
                    selectedRating = star.getAttribute('data-value');
                    ratingValueInput.value = selectedRating;
                    highlightStars(selectedRating);
                });
            });

            // Reset all stars to default
            function resetStars() {
                stars.forEach((star) => {
                    star.classList.remove('hovered', 'selected');
                });
            }

            // Highlight stars up to the given rating
            function highlightStars(rating) {
                stars.forEach((star) => {
                    if (star.getAttribute('data-value') <= rating) {
                        star.classList.add('selected');
                    }
                });
            }
        </script>

        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                });
            </script>
        @endif

    @endpush

    @push('styles')
        <style>
            /* Basic star styling */
            .rating {
                display: flex;
                align-items: center;
            }

            .rating i {
                font-size: 24px;
                color: #ccc;
                cursor: pointer;
                transition: color 0.2s;
            }

            .rating i.hovered, .rating i.selected {
                color: #f5b301; /* Active star color */
            }
        </style>
    @endpush




</x-front-layout>
