<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create',[
            'order' => $order,
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {

        // $amount = $order->total + $order->shipping + $order->shipping - $order->discount;
        $exchangeRate = 1.41; // Conversion rate from JOD to USD
        $amount = intval(round(($order->total + $order->shipping - $order->discount) * $exchangeRate) );


        /**
         * @var \Stripe\StripeClient
         */
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        try{
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount,
                'currency'=>$paymentIntent->currency,
                'method'=>'stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data'=> json_encode($paymentIntent),
            ]);
        } catch(QueryException $e) {
            echo $e->getMessage();
            return;
        }

        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }

    public function confirm(Request $request, Order $order)
    {

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve($request->query('payment_intent'), []);

        // dd($order);
        if($paymentIntent->status == 'succeeded'){
            try{

                $payment = Payment::where('order_id',$order->id)->first();
                $payment->status ='completed';
                $payment->transaction_data =json_encode($paymentIntent);
                $payment->save();


                $order->payment_method = 'stripe';
                $order->payment_status = 'paid';
                $order->save();


            } catch(QueryException $e) {
                echo $e->getMessage();
                return;
            }

            return redirect()->route('order.payment.invoice',[
            'order' => $order->id,
            'status'=>'payment-succeeded',
            ])->with('success','Payment Succeeded');
        }

        return redirect()->route('createStripePaymentIntent',$order->id)->with('error','Payment Faild!');





    }


    public function cod(Request $request, Order $order)
    {

        $order->payment_method = 'cod';
        $order->save;

        return redirect()->route('order.payment.invoice',$order->id)->with('success','Payment Succeeded!');





    }
}
