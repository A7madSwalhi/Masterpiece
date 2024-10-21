<div class="wsus__mini_cart">
    <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
    <ul>
        @forelse ($items as $item)
            <li>
                <div class="wsus__cart_img" id="{{ $item->id }}">
                    <a href="#"><img src="{{ $item->product->image_url }}" alt="product" class="img-fluid w-100"></a>
                    <a class="wsis__del_icon" href="#" wire:click.prevent="removeItem('{{ $item->id }}')"><i class="fas fa-minus-circle"></i></a>
                </div>
                <div class="wsus__cart_text">
                    <a class="wsus__cart_title" href="{{ route('products.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                    @if ($item->product->discount_price)
                        <p>{{ Currency::format($item->product->discount_price) }}
                        <del>{{ Currency::format($item->product->regular_price) }}</del></p>
                    @else
                        <p>{{ Currency::format($item->product->regular_price) }}</p>
                    @endif
                    <small>Quantity:{{ $item->quantity }}</small>
                </div>
            </li>
        @empty
            <p>The cart is empty</p>
        @endforelse
    </ul>
    <h5>sub total <span>{{ Currency::format($total) }}</span></h5>
    <div class="wsus__minicart_btn_area">
        <a class="common_btn" href="{{ route('cart.index') }}">view cart</a>
        <a class="common_btn" href="check_out.html">checkout</a>
    </div>
</div>
