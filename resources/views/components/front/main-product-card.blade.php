
<div class="col-xl-3 col-sm-6 col-lg-4">
    <div class="wsus__product_item">
        <span class="wsus__new">New</span>
        @if ($product->discount_price)
            <span class="wsus__minus">-{{ $product->discount_percentage }}%</span>
        @endif
        <a class="wsus__pro_link" href="{{ route("products.show",$product->slug) }}">
            <img src="{{ $product->image_url}}" alt="product" class="img-fluid w-100 img_1" />
            <img src="{{ asset('front/images/pro3_3.jpg') }}" alt="product" class="img-fluid w-100 img_2" />
        </a>
        <ul class="wsus__single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="far fa-eye"></i></a></li>
            <li><a href="#"><i class="far fa-heart"></i></a></li>
            <li><a href="#"><i class="far fa-random"></i></a>
        </ul>
        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{ $product->category->name }} </a>
            <p class="wsus__pro_rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span>(133 review)</span>
            </p>
            <a class="wsus__pro_name" href="{{ route("products.show",$product->slug) }}">{{ $product->name }}</a>
            @if ($product->discount_price)
                <p class="wsus__price">{{ Currency::format($product->discount_price) }} <del>{{ Currency::format($product->regular_price) }}</del></p>
            @else
                <p class="wsus__price">{{ Currency::format($product->regular_price) }}</p>
            @endif

            {{-- <form  class="shopping-cart-form" id="add-to-cart-form" > --}}

            <form action="{{ route('cart.store') }}" method="POST" class="shopping-cart-form" id="add-to-cart-form-{{ $product->id }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="add_cart" type="submit">Add to Cart</button>
            </form>


            {{-- <form class="shopping-cart-form ">
                <button class="add_cart add-to-cart-button" data-product-id="{{ $product->id }}">
                    Add to Cart
                </button>
            </form> --}}

        </div>
    </div>
</div>



{{-- <div class="wsus__product_item">

    <span class="wsus__minus">-20%</span>

    <a class="wsus__pro_link" href="product_details.html" tabindex="-1">
        <img src="images/pro9.jpg" alt="product" class="img-fluid w-100 img_1">
        <img src="images/pro9_9.jpg" alt="product" class="img-fluid w-100 img_2">
    </a>


    <ul class="wsus__single_pro_icon">
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" tabindex="-1">
                <i class="far fa-eye" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="#" tabindex="-1"><i class="far fa-heart" aria-hidden="true">
                </i>
            </a>
        </li>
        <li>
            <a href="#" tabindex="-1">
                <i class="far fa-random" aria-hidden="true"></i>
            </a>
        </li>
    </ul>


    <div class="wsus__product_details">
        <a class="wsus__category" href="#" tabindex="-1">fashion </a>
        <p class="wsus__pro_rating">
            <i class="fas fa-star" aria-hidden="true"></i>
            <i class="fas fa-star" aria-hidden="true"></i>
            <i class="fas fa-star" aria-hidden="true"></i>
            <i class="fas fa-star" aria-hidden="true"></i>
            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
            <span>(120 review)</span>
        </p>


        <a class="wsus__pro_name" href="#" tabindex="-1">men's fashion sholder bag</a>
        <p class="wsus__price">$159 <del>$200</del></p>

        <form action="">

            <button class="add_cart" href="#" tabindex="-1">add to cart</button>

        </form>
    </div>
</div> --}}
