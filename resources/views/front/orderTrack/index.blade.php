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
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form class="tack_form" action="{{ route('track.find') }}" method="POST">
                            @csrf
                            <h4 class="text-center">order tracking</h4>
                            <p class="text-center">tracking your order status</p>
                            <div class="wsus__track_input">
                                <label class="d-block mb-2">Invoice Number*</label>
                                <input type="text" name="invoice_no" placeholder="#H25-21578455">
                            </div>
                            <button type="submit" class="common_btn">track</button>
                        </form>
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
