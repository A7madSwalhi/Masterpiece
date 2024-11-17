<?php

namespace App\Http\Controllers\Vendor\dashboard;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function all(){
        $statuses = ['pending', 'processing', 'delivering', 'completed', 'cancelled'];
        $request = request();

        $orders = Order::whereIn('status', $statuses)
            ->whereHas('items', function ($query) {
                $query->where('vendor_id', auth('vendor')->user()->id);
            })
            ->filter($request->query())
            ->paginate();

        return view('store.Dashboard.orders.all',compact('orders'));
    }

    public function show(Order $order){
        $products = OrderItem::where('vendor_id', auth('vendor')->user()->id)
            ->where('order_id', $order->id)
            ->with('product')
            ->get();


        return view('store.Dashboard.orders.showOrder',compact('order','products'));
    }

    public function confirmed(){

        $request = request();

        $orders = Order::where('status', '=', 'confirmed')
            ->whereHas('items', function ($query) {
                $query->where('vendor_id', auth('vendor')->user()->id);
            })
            ->filter($request->query())
            ->paginate();

        return view('store.Dashboard.orders.confimed',compact('orders'));
    }

    public function process(Order $order)
    {
        // Ensure the order is associated with the vendor
        $vendorId = auth('vendor')->user()->id;

        // Get the order items related to the logged-in vendor and with process_status of 0
        $orderItems = $order->items()->where('vendor_id', $vendorId)->where('process_status', 0);

        if ($orderItems->exists()) {
            // Update the process_status of the related order items to 1
            $orderItems->update(['process_status' => 1]);

            // Check if all items in the order have process_status 1
            $allProcessed = $order->items()->where('process_status', '!=', 1)->count() === 0;

            if ($allProcessed) {
                // If all items are processed, update the order status to 'processing'
                $order->update([
                    'status' => 'processing',
                    'processing_date'=> Carbon::now(),

                ]);
            }

            return redirect()->route('vendor.orders.confirmed')->with('success','The order on Processing!');
        }

        // If no items are found for this vendor or items are already processed

    }


}
