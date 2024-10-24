<?php

namespace App\Http\Controllers\front;

use App\Models\Coupon;
use Throwable;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Repositories\Cart\CartRepository;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            // throw new InvalidOrderException('Cart is empty');
            return redirect()->route('home');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
        ]);

        $items = $cart->get()->groupBy('product.vendor_id')->all();
        $firstitem = reset($items)->first();
        if ($firstitem ) {
            $coupon = Coupon::find($firstitem->coupon_id)->coupon_code;
        }else{
            $coupon = null;
        }

        DB::beginTransaction();

        try {

            $order = Order::create([
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                    'total' => $cart->total(),
                    'discount' => $cart->discount(),
                    'coupon' => $coupon
            ]);

            foreach ($items as $vendor_id => $cart_items) {


                foreach ($cart_items as $item) {
                    if($item->product->discount_price){
                        $price = $item->product->discount_price;
                    }else{
                        $price = $item->product->regular_price;
                    }


                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'vendor_id' => $item->product->vendor->id,
                        'product_name' => $item->product->name,
                        'price' => $price,
                        'quantity' => $item->quantity,
                        'options' =>$item->options
                    ]);
                }

            }

            foreach ($request->post('addr') as $type => $address) {

                $address['type'] = $type;
                $order->addresses()->create(attributes: $address);

            }


            DB::commit();

            $cart->empty();

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('home' );
    }
}
