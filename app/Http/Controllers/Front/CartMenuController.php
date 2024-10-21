<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartMenuController extends Controller
{
    public function getCartData()
{
    // Render the CartMenu component
    $cartMenuHtml = view('components.cart-menu')->render();

    return response()->json([
        'cart_menu_html' => $cartMenuHtml
    ]);
}
}
