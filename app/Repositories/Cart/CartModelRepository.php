<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get() : Collection
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->get();
        }

        return $this->items;
    }

    public function add(Product $product, $quantity = 1, $color=Null, $size=Null)
    {
        $item =  Cart::where('product_id', '=', $product->id)
            ->first();
        if ($size || $color) {
                $options = [];

                if($color){
                    $options['color'] = $color;
                }

                if($size){
                    $options['size'] = $size;
                }

                $jsonData = json_encode($options, JSON_PRETTY_PRINT);

            if (!$item) {
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'options' => $jsonData,
                ]);
                $this->get()->push($cart);
                return $cart;
            }
        }else{

            if (!$item) {
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
                $this->get()->push($cart);
                return $cart;
            }

        }


        return $item->increment('quantity', $quantity);
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total() : float
    {
        /*return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');*/

        return $this->get()->sum(function($item) {

            if($item->product->discount_price){
                return $item->quantity * $item->product->discount_price;
            }
            return $item->quantity * $item->product->regular_price;
        });
    }

    public function discount(){

        $coupon = Cart::whereNotNull('coupon_id')->first();
        if ($coupon) {
            $co = Coupon::find($coupon->coupon_id);
            return $this->total() *  $co->discount;
        }

        return 0.00;
    }
}
