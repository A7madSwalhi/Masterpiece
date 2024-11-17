<x-front-layout>

    <x:$breadcrumb>
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>invoice</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('products.index') }}">Products</a></li>
                                <li><a href="#">complete order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>


    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__invoice_area">
                <div class="wsus__invoice_header">
                    <div class="wsus__invoice_content">
                        <div class="row">

                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single">
                                    <h5>Invoice To</h5>
                                    <h6>{{$order->billingAddress->first_name. " " . $order->billingAddress->last_name }}</h6>
                                    <p>City: {{ $order->billingAddress->city }}</p>
                                    <p>Street: {{ $order->billingAddress->street_address }}</p>
                                    <p>Phone: {{ $order->billingAddress->phone_number }}</p>
                                </div>
                            </div>


                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h5>shipping information</h5>
                                    <h6>{{$order->shippingAddress->first_name. " " . $order->shippingAddress->last_name }}</h6>
                                    <p>City: {{ $order->shippingAddress->city }}</p>
                                    <p>Street: {{ $order->shippingAddress->street_address }}</p>
                                    <p>Phone: {{ $order->shippingAddress->phone_number }}</p>
                                </div>
                            </div>


                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>Payment Details</h5>
                                    <h6>Invoice No: {{ $order->invoice_no  }}</h6>
                                        @if ($order->payment_method == 'cod')
                                            <p>Payment Method: Cash On Delivery</p>
                                        @else
                                            <p>Payment Method: {{ $order->payment_method }}</p>
                                        @endif
                                    <p>Order Status:
                                        @if ($order->status == 'pending')
                                            <span class="badge rounded-pill bg-warning">{{$order->status}}</span>
                                        @elseif ($order->status == 'confirmed')
                                            <span class="badge rounded-pill bg-success ">{{$order->status}}</span>
                                        @elseif ($order->status == 'processing')
                                            <span class="badge rounded-pill bg-dark ">{{$order->status}}</span>
                                        @elseif ($order->status == 'delivering')
                                            <span class="badge rounded-pill bg-info ">{{$order->status}}</span>
                                        @elseif ($order->status == 'completed')
                                            <span class="badge rounded-pill bg-primary ">{{$order->status}}</span>
                                        @elseif ($order->status == 'cancelled')
                                            <span class="badge rounded-pill bg-danger ">{{$order->status}}</span>
                                        @endif
                                        </p>
                                    <p>payment Status: {{ $order->payment_status }}</p>
                                    
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="wsus__invoice_description">
                        <div class="table-responsive">
                            <table class="table">

                                <tr>
                                    <th class="images">
                                        images
                                    </th>

                                    <th class="name">
                                        product
                                    </th>

                                    <th class="amount">
                                        amount
                                    </th>

                                    <th class="quentity">
                                        quentity
                                    </th>
                                    <th class="total">
                                        total
                                    </th>
                                </tr>

                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="images">
                                        <img src="{{ $item->product->image_url }}" alt="bag" class="img-fluid w-100">
                                    </td>

                                    <td class="name">
                                        <p>{{ $item->product_name }}</p>
                                        @php
                                            if($item->options){
                                                $data = json_decode($item->options, true);
                                            }
                                        @endphp
                                        @if ($item->options)
                                            @if ($data['color'])
                                                <span>color: {{ $data['color'] }}</span>
                                            @endif
                                            @if ($data['size'])
                                                <span>size: {{ $data['size'] }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="amount">
                                        {{ Currency::format($item->price) }}
                                    </td>

                                    <td class="quentity">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="total">
                                        {{ Currency::format($item->quantity * $item->price) }}
                                    </td>
                                </tr>
                            @endforeach



                            </table>
                        </div>
                    </div>
                </div>


                <div class="wsus__invoice_footer">
                    <p><span>Shipping fee:</span> {{Currency::format( $order->shipping )}}</p>
                    <p><span>Tax:</span> {{Currency::format( $order->tax )}}</p>
                    <p><span>Discount: </span> {{Currency::format( $order->discount )}}</p>
                    <p><span>Total Amount:</span> {{Currency::format( $order->total - $order->discount + $order->tax + $order->shipping )}} </p>
                </div>


            </div>
        </div>
    </section>




</x-front-layout>


