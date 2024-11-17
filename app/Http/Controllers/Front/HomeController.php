<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index(){
        $brands = Brand::where('status','=','active')->get();
        $products = Product::with('category')->active()->limit(8)->get();

        return view('front.home',compact('products','brands'));

    }
}
