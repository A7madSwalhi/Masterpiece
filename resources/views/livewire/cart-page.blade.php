@if (count($cartItems))

        <section id="wsus__cart_view">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="wsus__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>

                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                product item
                                            </th>

                                            <th class="wsus__pro_name">
                                                product details
                                            </th>

                                            <th class="wsus__pro_status">
                                                unit price
                                            </th>

                                            <th class="wsus__pro_select">
                                                quantity
                                            </th>

                                            <th class="wsus__pro_tk">
                                                price
                                            </th>

                                            <th class="wsus__pro_icon">
                                                <a href="#" class="common_btn" wire:click.prevent="clearCart">clear cart</a>
                                            </th>
                                        </tr>
                                        @foreach ($cartItems as $item)

                                            <tr class="d-flex" id="{{ $item->id }}">
                                                <td class="wsus__pro_img"><img src="{{ $item->product->image_url }}" alt="product"
                                                        class="img-fluid w-100">
                                                </td>

                                                <td class="wsus__pro_name">
                                                    <p>
                                                        <a href="{{ route('products.show',$item->product->slug) }}">
                                                            {{ $item->product->name }}</p>
                                                        </a>
                                                    {{-- <span>color: red</span>
                                                    <span>size: XL</span> --}}
                                                </td>

                                                <td class="wsus__pro_status">
                                                    @if ($item->product->discount_price)
                                                        <p> {{ Currency::format($item->product->discount_price) }} </p>
                                                    @else
                                                        <p> {{ Currency::format($item->product->regular_price) }} </p>
                                                    @endif
                                                </td>

                                                <td class="wsus__pro_select">
                                                    {{-- <form class="select_number">
                                                        <input class="number_area" type="text" min="1" max="100" value="{{ $item->quantity }}" />
                                                    </form> --}}
                                                    <form class="select_number">
                                                        <span class="spinner">
                                                            <span class="sub" wire:click="decreaseQuantity({{ $item->id }})">-</span>
                                                            <input class="number_area"  value="{{ $item->quantity }}" type="text" min="1" max="100"  >
                                                            <span class="add" wire:click="increaseQuantity({{ $item->id }})">+</span>
                                                        </span>
                                                    </form>
                                                </td>

                                                <td class="wsus__pro_tk">
                                                    @if ($item->product->discount_price)
                                                        <p> {{ Currency::format($item->product->discount_price * $item->quantity) }} </p>
                                                    @else
                                                        <p> {{ Currency::format($item->product->regular_price * $item->quantity) }} </p>
                                                    @endif
                                                </td>

                                                <td class="wsus__pro_icon">
                                                    <a href="#" data-id="{{ $item->id }}" class="remove-item" wire:click.prevent="removeItem('{{ $item->id }}')">
                                                        <i class="far fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                            <h6>total cart</h6>
                            <p>subtotal: <span>{{ Currency::format($total ) }}</span></p>
                            <p>Discount: <span>{{ Currency::format($discount ) }}</span></p>
                            <p class="total"><span>total:</span> <span>{{ Currency::format($total - $discount ) }}</span></p>

                            <form wire:submit.prevent="applyCoupon">
                                <input type="text" placeholder="Coupon Code" wire:model.defer="couponCode">
                                <button type="submit" class="common_btn">apply</button>
                            </form>
                            @if (session()->has('error'))
                                    <span class="text-danger ms-2 mt-2">
                                        {{ session('error') }}
                                    </span>
                            @endif
                            <a class="common_btn mt-4 w-100 text-center" href="{{ route('checkout') }}">checkout</a>
                            <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                    class="fab fa-shopify"></i> go shop</a>
                        </div>
                    </div>


                </div>
            </div>
        </section>


    @else

        <section id="wsus__cart_view">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__cart_list cart_empty p-3 p-sm-5 text-center">
                            <p class="mb-4">your shopping cart is empty</p>
                            <a href="{{ route('products.index') }}" class="common_btn">
                                <i class="fal fa-store me-2" aria-hidden="true">
                                </i>
                                view our product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif



