<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Coupon;
use Livewire\Component;
use App\Models\Cart as CartModel;

class CartPage extends Component
{
    public $cartItems = [];
    public $total = 0;

    public $discount = 0.00;

    public $couponCode = '';

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = Cart::get();
        $this->total = Cart::total();
        $this->discount = Cart::discount();
        $this->dispatch('cartUpdated');
    }

    public function updateQuantity($itemId, $quantity)
    {
        Cart::update($itemId, $quantity); // Update item quantity
        $this->loadCart(); // Reload cart items
    }

    public function removeItem($itemId)
    {
        Cart::delete($itemId); // Remove item from the cart
        $this->loadCart(); // Reload cart items
    }

    public function clearCart()
    {
        Cart::empty(); // Use the empty() method to clear the cart
        $this->loadCart(); // Reload cart items
    }

    public function increaseQuantity($itemId)
    {
        dd('increaseQuantity triggered for item ID: ' . $itemId);
        // Get the current quantity of the item
        $currentQuantity = $this->cartItems[$itemId]['quantity'];

        // Increase the quantity
        $newQuantity = $currentQuantity + 1;

        // Update the cart in the backend
        Cart::update($itemId, $newQuantity);

        // Manually update the cartItems array to reflect the new quantity
        $this->cartItems[$itemId]['quantity'] = $newQuantity;

        // Optionally reload the cart (if needed for total recalculation)
        $this->loadCart();
    }

    public function decreaseQuantity($itemId)
    {
        // Get the current quantity of the item
        $currentQuantity = $this->cartItems[$itemId]['quantity'];

        // Ensure quantity doesn't go below 1
        if ($currentQuantity > 1) {
            $newQuantity = $currentQuantity - 1;

            // Update the cart in the backend
            Cart::update($itemId, $newQuantity);

            // Manually update the cartItems array to reflect the new quantity
            $this->cartItems[$itemId]['quantity'] = $newQuantity;

            // Optionally reload the cart (if needed for total recalculation)
            $this->loadCart();
        }
    }



    public function applyCoupon()
    {
        // Check if the coupon exists
        $coupon = Coupon::where('coupon_code', $this->couponCode)
                    ->where('status', 1) // Active status
                    ->where('validity', '>', now())
                    ->first();

        if (!$coupon) {
            // Optionally show an error message if the coupon doesn't exist
            session()->flash('error', 'Invalid coupon code.');
            return;
        }

        // dd($coupon );

        $carts = CartModel::all();
        foreach ($carts as $cart) {

            $cart->coupon_id = $coupon->id;
            $cart->save();

        // dd($carts );
        }



        // $cart->update([
        //     'coupon_id'=> $coupon->id,
        // ]);

        // Reload the cart to reflect the coupon application
        $this->loadCart();

        // Optionally show a success message
        // $this->dispatchBrowserEvent('couponApplied', ['message' => 'Coupon applied successfully!']);


    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
