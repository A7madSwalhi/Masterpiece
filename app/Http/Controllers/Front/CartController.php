<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;

class CartController extends Controller
{


    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.cart', [
            'cart' => $this->cart,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->post('color') && $request->post('size')) {
            $request->validate([
                'product_id' => ['required', 'int', 'exists:products,id'],
                'quantity' => ['nullable', 'int', 'min:1'],
                'color' => ['required'],
                'size'=>['required']
            ]);
        }elseif($request->post('color')){
            $request->validate([
                'product_id' => ['required', 'int', 'exists:products,id'],
                'quantity' => ['nullable', 'int', 'min:1'],
                'color' => ['required'],
            ]);
        }elseif($request->post('size')){
            $request->validate([
                'product_id' => ['required', 'int', 'exists:products,id'],
                'quantity' => ['nullable', 'int', 'min:1'],
                'size'=>['required']
            ]);
        }else{
            $request->validate([
                'product_id' => ['required', 'int', 'exists:products,id'],
                'quantity' => ['nullable', 'int', 'min:1'],
            ]);
        }

        $product = Product::findOrFail($request->post('product_id'));
        $quantity = $request->post('quantity') ?? 1;
        $color = $request->post('color') ?? Null;
        $size = $request->post('size') ?? Null;

        // dd($request->post('quantity'));
        
        $this->cart->add($product, $quantity,$color,$size);

        if ($request->expectsJson()) {

            return response()->json([
                'message' => 'Item added to cart!',
            ], 201);
        }

        // return redirect()->route('cart.index')
        //     ->with('success', 'Product added to cart!');

        return redirect()->back()->with('success', 'Product added to cart!');

        }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);

        $this->cart->update($id, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->cart->delete($id);

        return [
            'message' => 'Item deleted!',
        ];
    }


}
