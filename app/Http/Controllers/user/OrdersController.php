<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){

        $orders = Order::where('user_id','=',auth()->user()->id )->orderByDesc('created_at')->paginate();

        return view('user.orders',compact('orders'));
    }

    public function show(Order $order){

        return view('user.orderDetails',compact('order'));
    }

    public function cancel(Order $order){

        $order->status = 'cancelled';
        $order->cancel_date = Carbon::now();
        $order->save();

        return redirect()->back()->with('success','Order Cancelled!');
    }
    public function return(Order $order,Request $request){
        $request->validate([
            'refunded_reason' => ['required','string'],
        ]);

        $order->status = 'refunded';
        $order->refunded_date = Carbon::now();
        $order->refunded_reason = $request->post('refunded_reason');
        $order->save();

        return redirect()->back()->with('success','Order Refunded!');
    }
    public function allReviews(){
        $reviews = ProductReview::where('user_id','=',auth()->user()->id)->orderByDesc('created_at')->get();
        // dd($reviews);
        return view('user.allReviews',compact('reviews'));
    }
    public function updateReviews(Request $request, $id){

        $review = ProductReview::findOrFail($id);

        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'string', 'min:3']
        ]);

        $review->update([
            'user_id' => auth()->user()->id,
            'product_id' => $review->product_id ,
            'review' => $request->post('review'),
            'rating' => $request->post('rating'),
        ]);

        return redirect()->route('user.profile.reviews')->with('success','Review Updated!');
    }
    public function deleteReviews($id){
        $review = ProductReview::findOrFail($id);

        $review->delete();

        return redirect()->route('user.profile.reviews')->with('success','Review deleted!');
    }


}
