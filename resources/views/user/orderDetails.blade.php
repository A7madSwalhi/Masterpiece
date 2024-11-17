@extends('user.layout.layout')

@section('title','User Orders')

@section('content')
        <div class="dashboard_content">
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
                                        @elseif ($order->status == 'refunded')
                                            <span class="badge rounded-pill bg-danger ">returned</span>
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

            @if ($order->status == 'completed')

                <div class="wsus__message">
                    <h4>Return Order</h4>
                    <form action="{{ route('user.orders.return',$order->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="wsus__single_inout">
                                    <label>The Reason For Return Order</label>
                                    <textarea name="refunded_reason" cols="3" rows="3" placeholder="Write Your Problem Here"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="common_btn" type="submit">return</button>
                    </form>
                </div>

            @endif

            @if ($order->status == 'refunded')

                <div class="wsus__message">
                    <h4>Return Order</h4>
                <table class="table m-auto">
                        <thead>
                            <tr>
                                <th class="package">Invoice No</th>
                                <th class="tr_id">Refunded Date</th>
                                <th class="e_date">Payment Method</th>
                                <th class="price">Price</th>
                                <th class="method">Return Reason</th>
                                <th class="method">Return Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="package">{{ $order->invoice_no  }}</td>
                                <td class="tr_id">{{ $order->refunded_date }}</td>
                                <td class="e_date">
                                    @if ( $order->payment_method == 'cod')
                                        {{ "Cash On Delevery" }}
                                    @else
                                        {{ $order->payment_method }}
                                    @endif
                                </td>
                                <td class="price">{{ Currency::format( $order->total + $order->tax + $order->shipping - $order->discount ) }}</td>
                                <td class="method">
                                    {{ $order->refunded_reason }}
                                </td>
                                <td class="method">
                                    @if ($order->refunded_status == 'pending')
                                        <span class="badge rounded-pill bg-warning">{{$order->status}}</span>
                                    @elseif ($order->refunded_status == 'accepted')
                                        <span class="badge rounded-pill bg-success ">{{$order->status}}</span>
                                    @elseif ($order->refunded_status == 'rejected')
                                        <span class="badge rounded-pill bg-danger ">{{$order->status}}</span>
                                    @endif
                                </td>


                            </tr>


                    </tbody>

                </table>

            </div>

            @endif


        </div>
@endsection


@push('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            $('#image-form').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if ($errors->any())
            <script>
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": 0,
                    "extendedTimeOut": 0,
                    "onclick": function() { toastr.clear(); }
                };
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach

            </script>
        @endif

    <x-flashtoaster />
@endpush
