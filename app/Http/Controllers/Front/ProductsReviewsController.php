<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsReviewsController extends Controller
{
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'string', 'min:3']
        ]);

        ProductReview::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'review' => $request->post('review'),
            'rating' => $request->post('rating'),
        ]);

        return redirect()->route('products.show', $product)->with('success', 'Your comment has been added!');
    }
}
