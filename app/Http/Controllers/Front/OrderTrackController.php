<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackController extends Controller
{
    public function index(){
        return view('front.orderTrack.index');
    }
    public function find(Request $request){

        $request->validate([
            'invoice_no' => ['required','exists:orders,invoice_no']
        ]);

        $order = Order::where('invoice_no','=',$request->post('invoice_no'))->first();


        return view('front.orderTrack.find',compact('order'));

    }



}
