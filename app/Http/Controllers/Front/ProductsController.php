<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){

    }

    public function show(Product $product){
        // dd($product);
        return view("front.products.show",compact('product'));
    }
}