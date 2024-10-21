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
                                <li><a href="{{ route('products.index') }}">Products</a></li>
                                <li><a href="#">Product Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>



    <section id="wsus__product_details">
        <div class="container">

            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5" style="z-index:999">
                        <div id="sticky_pro_zoom" >
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{$product->image_url}}" alt="product"></li>
                                        @foreach ($product->galleries as $productImage)
                                            <li><img class="zoom ing-fluid w-100" src="{{asset('storage/'.$productImage->image)}}" alt="product"></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="javascript:;">{{$product->name}}</a>
                            @if ($product->quantitiy > 0)
                            <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{$product->quantitiy}} item)</p>
                            @elseif ($product->quantitiy === 0)
                            <p class="wsus__stock_area"><span class="in_stock">stock out</span> ({{$product->quantitiy}} item)</p>
                            @endif

                            @if ($product->discount_price)
                                <h4>{{ Currency::format($product->discount_price) }} <del>{{ Currency::format($product->regular_price) }}</del></h4>
                            @else
                                <h4>{{ Currency::format($product->regular_price) }}</h4>
                            @endif


                            <p class="wsus__pro_rating">
                                @php
                                $avgRating = $product->reviews()->avg('rating');
                                $fullRating = round($avgRating);
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullRating)
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                @endfor

                                <span>({{count($product->reviews)}} review)</span>
                            </p>


                            <p class="description">{{ $product->short_description }}</p>



                            <form class="shopping-cart-form" id="add-to-cart-form-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                {{-- <div class="wsus__selectbox">
                                    <div class="row">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        @foreach ($product->variants as $variant)
                                        @if ($variant->status != 0)
                                            <div class="col-xl-6 col-sm-6">
                                                <h5 class="mb-2">{{$variant->name}}: </h5>
                                                <select class="select_2" name="variants_items[]">
                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                        @if ($variantItem->status != 0)
                                                            <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        @endforeach

                                    </div>
                                </div> --}}
                                <input type="hidden" name='product_id' value="{{ $product->id }}" >

                                <div class="wsus__quentity">
                                    <h5>quentity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="quantitiy" type="number" min="1" max="100" value="1" />
                                    </div>

                                </div>


                                <ul class="wsus__button_area">
                                    <li><button type="submit" class="add_cart" href="#">add to cart</button></li>


                                    <li><a style="border: 1px solid gray;
                                        padding: 7px 11px;
                                        border-radius: 100%;" href="javascript:;" class="add_to_wishlist" data-id="{{$product->id}}"><i class="fal fa-heart"></i></a></li>

                                    <li>
                                        <button type="button" style="border: 1px solid gray;
                                        padding: 7px 11px;
                                        margin-left: 7px;
                                        border-radius: 100%; background-color: #0088cc" class="btn"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="far fa-comment-alt text-light"></i>
                                        </button>

                                    </li>




                                </ul>
                            </form>

                            <p class="brand_model"><span>brand :</span> {{$product->brand->name}}</p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                {{-- {!!$product->long_description!!} --}}
                                               {{ $product->long_description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{asset($product->vendor->cover_image_url )}}" alt="vensor" class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{$product->vendor->name}}</h4>
                                                    @if ($product->vendor->profile)
                                                        <p><span>Store Name:</span> {{$product->vendor->shop_name}}</p>
                                                        <p><span>Country:</span> {{$product->vendor->profile->country}}</p>
                                                        <p><span>City:</span> {{$product->vendor->profile->city}}</p>
                                                        <p><span>Address:</span> {{$product->vendor->profile->street_address}}</p>
                                                        <p><span>Phone:</span> {{$product->vendor->profile->phone}}</p>
                                                        <p><span>Email:</span> {{$product->vendor->email}}</p>
                                                    @endif
                                                    <a href="vendor_details.html" class="see_btn">visit store</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details">
                                                    {{-- {!!$product->vendor->description!!} --}}
                                                    {{ $product->vendor->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Reviews <span>{{count($product->reviews)}}</span></h4>
                                                        @foreach ($product->reviews as $review)
                                                        <div class="wsus__main_comment">
                                                            <div class="wsus__comment_img">
                                                                <img src="{{asset($review->user->profile->image)}}" alt="user"
                                                                    class="img-fluid w-100">
                                                            </div>
                                                            <div class="wsus__comment_text reply">
                                                                <h6>{{$review->user->name}} <span>{{$review->rating}} <i
                                                                            class="fas fa-star"></i></span></h6>
                                                                <span>{{date('d M Y', strtotime($review->created_at))}}</span>
                                                                <p>{{$review->review}}
                                                                </p>
                                                                <ul class="">
                                                                    @if (count($review->productReviewGalleries) > 0)

                                                                    @foreach ($review->productReviewGalleries as $image)

                                                                    <li><img src="{{asset($image->image)}}" alt="product"
                                                                            class="img-fluid "></li>
                                                                    @endforeach
                                                                    @endif

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                        {{-- <div class="mt-5">
                                                            @if ($reviews->hasPages())
                                                                {{$reviews->links()}}
                                                            @endif
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                    @auth
                                                    @php
                                                        $isBrought = false;
                                                        $orders = \App\Models\Order::where(['user_id' => auth()->user()->id, 'order_status' => 'delivered'])->get();
                                                        foreach ($orders as $key => $order) {
                                                           $existItem = $order->orderProducts()->where('product_id', $product->id)->first();

                                                           if($existItem){
                                                            $isBrought = true;
                                                           }
                                                        }

                                                    @endphp

                                                    @if ($isBrought === true)
                                                    <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                        <h4>write a Review</h4>
                                                        <form action="{{route('user.review.create')}}" enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            <p class="rating">
                                                                <span>select your rating : </span>
                                                            </p>

                                                            <div class="row">

                                                                <div class="col-xl-12 mb-4">
                                                                    <div class="wsus__single_com">
                                                                        <select name="rating" id="" class="form-control">
                                                                            <option value="">Select</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="col-xl-12">
                                                                        <div class="wsus__single_com">
                                                                            <textarea cols="3" rows="3" name="review"
                                                                                placeholder="Write your review"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="img_upload">
                                                                <div class="">
                                                                    <input type="file" name="images[]" multiple>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="product_id" id="" value="{{$product->id}}">
                                                            <input type="hidden" name="vendor_id" id="" value="{{$product->vendor_id}}">

                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                    @endauth

                                                </div> --}}
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
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="" class="message_modal">
                        @csrf
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea name="message" class="form-control mt-2 message-box"></textarea>
                            <input type="hidden" name="receiver_id" value="{{ $product->vendor->user_id }}">
                        </div>
                        <button type="submit" class="btn add_cart mt-4 send-button">Send</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- @push('scripts')
        <script>
            $(document).ready(function () {
                $('#add-to-cart-form').on('submit', function (e) {
                    e.preventDefault(); // Prevent form from submitting normally

                    let formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: formData,
                        success: function (response) {

                            toastr.success('Item added to cart successfully!');


                        },
                        error: function (xhr) {
                            // Handle error
                            toastr.error('Failed to add item to cart.');
                        }
                    });
                });
            });
        </script>
    @endpush --}}


</x-front-layout>
