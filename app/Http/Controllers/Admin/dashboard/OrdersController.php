<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function pending(){
        $request = request();

        $orders = Order::where('status','=','pending')->filter($request->query())->paginate();

        return view('Admin.Dashboard.orders.pending',compact('orders'));
    }

    public function confirmed(){
        $request = request();

        $orders = Order::where('status','=','confirmed')->filter($request->query())->paginate();

        return view('Admin.Dashboard.orders.confimed',compact('orders'));
    }

    public function processing(){
        $request = request();

        $orders = Order::where('status', '=', 'processing')
            ->whereDoesntHave('items', function ($query) {
                $query->where('process_status', '=', 0);
            })
            ->filter($request->query())
            ->paginate();

        return view('Admin.Dashboard.orders.processing',compact('orders'));
    }

    public function delivering(){
        $request = request();

        $orders = Order::where('status','=','delivering')->filter($request->query())->paginate();

        return view('Admin.Dashboard.orders.delivering',compact('orders'));
    }

    public function completed(){
        $request = request();

        $orders = Order::where('status','=','completed')->filter($request->query())->paginate();

        return view('Admin.Dashboard.orders.completed',compact('orders'));
    }





    public function show(Order $order){
        // dd($order->products);
        return view('Admin.Dashboard.orders.showOrder',compact('order'));
    }

    public function confirmOrder(Order $order){
        $order->status = 'confirmed';
        $order->confirmed_date = Carbon::now();
        $order->save();

        return redirect()->route('admin.orders.confirmed')->with('success','The order Confirmed Successfully!');
    }
    public function processOrder(Order $order){
        $order->status = 'processing';
        $order->confirmed_date = Carbon::now();
        $order->items()->where('process_status', 0)->update(['process_status' => 1]);
        $order->save();

        return redirect()->route('admin.orders.delivering')->with('success','The order Confirmed Successfully!');
    }


    public function shppingOrder(Order $order){
        $order->status = 'delivering';
        $order->shipped_date = Carbon::now();
        $order->save();

        return redirect()->route('admin.orders.completed')->with('success','The order on delivery Now!');
    }

    public function completeOrder(Order $order){
        $order->status = 'completed';
        $order->delivered_date = Carbon::now();

        if ($order->payment_method == 'cod') {
            $order->payment_status = 'paid';
        }


        $order->save();

        return redirect()->back()->with('success','The order on delivery Now!');
    }
}
