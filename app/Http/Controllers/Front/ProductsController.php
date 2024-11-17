<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpOption\None;

class ProductsController extends Controller
{
    public function index(Request $request){

        $filters = $request->only(['name', 'vendor_id', 'category_id', 'brand_id', 'featured', 'discount_price']);
        $products = Product::shopFilter($filters)->paginate(12);

        $categories = Category::where('parent_id','=',Null)->where('status','=','active')->get();
        $brands = Brand::where('status','=','active')->get();
        // dd($brands);
        return view('front.products.index',compact('products','categories','brands'));

    }

    public function show(Product $product){
        // dd($product);

        if($product->options){

            $options =  json_decode($product->options, true);
            $colors = $options['colors'] ;
            $sizes = $options['sizes'] ;
            // dd($colors,$sizes);
            return view("front.products.show",compact('product','colors','sizes'));
        }else{
            $colors = Null;
            $sizes = Null;
            return view("front.products.show",compact('product','colors','sizes'));
        }

    }
}
