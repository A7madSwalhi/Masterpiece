<?php

namespace App\Livewire;

use Livewire\Component;
use App\Facades\Cart;

class CartMenu extends Component
{
    public $items;
    public $total;
    public $itemCount;

    protected $listeners = ['cartUpdated' => 'refreshCart', 'itemAddedToCart' => 'addToCart'];

    public function mount()
    {
        $this->refreshCart();
    }

    public function refreshCart()
    {
        $this->items = Cart::get(); // Fetch cart items from the Cart
        $this->total = Cart::total(); // Fetch the cart subtotal
        $this->dispatch('cartCountUpdated', count($this->items));     }

    public function removeItem($itemId)
    {
        Cart::delete($itemId); // Remove item from the cart
        // $this->emit('cartUpdated'); // Trigger an event to update the cart view
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-menu');
    }


}
