<x-front-layout :title="'Products'">

    <x:$breadcrumb>
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>Products</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('products.index') }}">Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>



    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="wsus__sidebar_filter ">
                        <p>filter</p>
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>

                    <div class="wsus__product_sidebar" id="sticky_sidebar">
                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        All Categories
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @forelse ($categories as $category)
                                                <li><a href="{{ route('products.index') . '?category_id=' . $category->id }}">{{ $category->name }}</a></li>
                                            @empty

                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Price
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <input type="hidden" id="slider_range" class="flat-slider" />
                                            <button type="submit" class="common_btn">filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        All Brands
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @forelse ($brands as $brand)
                                                <li><a href="{{ route('products.index') . '?brand_id=' . $brand->id }}">{{ $brand->name }}</a></li>
                                            @empty

                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>






                            <div class="wsus__topbar_select mt-3">
                                <select class="select_2" name="state">
                                    <option>default shorting</option>
                                    <option>short by rating</option>
                                    <option>short by latest</option>
                                    <option>low to high </option>
                                    <option>high to low</option>
                                </select>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @forelse ($products as $product)
                                    <div class="col-xl-4  col-sm-6">
                                        <x-front.main-product-card :product="$product"/>
                                    </div>
                                    @empty
                                        <div class="text-center mt-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2>Product not found!</h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @forelse ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                @if ($product->created_at->greaterThanOrEqualTo(now()->subWeek()))
                                                    <span class="wsus__new">New</span>
                                                @endif
                                                @if ($product->discount_percentage)
                                                    <span class="wsus__minus">-{{ $product->discount_percentage }}%</span>
                                                @endif
                                                <a class="wsus__pro_link" href="{{ route('products.show',$product->slug) }}">
                                                    <img src="{{ $product->image_url}}" alt="product"
                                                        class="img-fluid w-100 img_1" />
                                                    @if ($product->galleries()->first()?->image)
                                                        <img src="{{ asset("storage/" . $product->galleries()->first()->image) }}" alt="product"
                                                            class="img-fluid w-100 img_2" />
                                                    @endif
                                                </a>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category" href="#">{{ $product->category->name }}</a>
                                                    @php
                                                        $avgRating = $product->reviews()->avg('rating');
                                                        $fullRating = round($avgRating);
                                                    @endphp
                                                    <p class="wsus__pro_rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $fullRating)
                                                        <i class="fas fa-star" style="color:#f5b301"></i>
                                                        @else
                                                        <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                        <span>({{ count($product->reviews)  }} review)</span>
                                                    </p>
                                                    <a class="wsus__pro_name" href="{{ route("products.show",$product->slug) }}">{{ $product->name }}</a>
                                                    @if ($product->discount_price)
                                                        <p class="wsus__price">{{ Currency::format($product->discount_price) }} <del>{{ Currency::format($product->regular_price) }}</del></p>
                                                    @else
                                                        <p class="wsus__price">{{ Currency::format($product->regular_price) }}</p>
                                                    @endif
                                                    <p class="list_description">
                                                        {{ $product->short_description }}
                                                    </p>
                                                    <ul class="wsus__single_pro_icon">
                                                        <li>
                                                            <form action="{{ route('cart.store') }}" method="POST" class="shopping-cart-form" id="add-to-cart-form-{{ $product->id }}">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button class="add_cart" type="submit">Add to Cart</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center mt-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2>Product not found!</h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <section id="pagination">
                        {{ $products->withQueryString()->links('pagination.custome') }}
                    </section>
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
