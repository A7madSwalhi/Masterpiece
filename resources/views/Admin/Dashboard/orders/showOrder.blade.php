@extends("Admin.layout.dashboard")

@section("pagetitle","Order Details")

@section("title","Order Details")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"><a href="{{route("admin.orders.pending")}}">Pending Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
@endsection






@section('content')

    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Shipping Details</h4>
                </div>
                <hr>

                <div class="card-body">
                    <table class="table" style="background:#F4F6FA;font-weight: 600;">

                        <tr>
                            <th>Shipping Name:</th>
                            <th>{{ $order->shippingAddress->first_name . " " . $order->shippingAddress->last_name }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Phone:</th>
                            <th>{{ $order->shippingAddress->phone_number }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Email:</th>
                            <th>{{ $order->shippingAddress->email }}</th>
                        </tr>

                        <tr>
                            <th>City:</th>
                            <th>{{ $order->shippingAddress->city }}</th>

                            <tr>
                                <th>Shipping Address:</th>
                                <th>{{ $order->shippingAddress->street_address }}</th>
                            </tr>

                        </tr>

                        <tr>
                            <th>Apartment:</th>
                            <th>{{ $order->shippingAddress->apartment }}</th>
                        </tr>

                        <tr>
                            <th>State :</th>
                            <th>{{ $order->shippingAddress->state }}</th>
                        </tr>

                        <tr>
                            <th>Post Code  :</th>
                            <th>{{ $order->shippingAddress->postal_code }}</th>
                        </tr>

                        <tr>
                            <th>Order Date   :</th>
                            <th>{{ $order->created_at }}</th>
                        </tr>

                    </table>

                </div>

            </div>
        </div>


        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details <span class="text-danger">Invoice : {{ $order->invoice_no }} </span></h4>
                </div>
                <hr>
                <div class="card-body">

                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                        <tr>
                            <th> Name :</th>
                            <th>{{ $order->billingAddress->first_name . " " . $order->billingAddress->last_name }}</th>
                        </tr>

                        <tr>
                            <th>Phone :</th>
                            <th>{{ $order->billingAddress->phone_number }}</th>
                        </tr>

                        <tr>
                            <th>Payment Type:</th>
                            @if (strtolower($order->payment_method) == 'cod')
                                <th>Cash on Delivery</th>
                            @else
                                <th>{{ ucfirst($order->payment_method) }}</th>
                            @endif
                        </tr>


                        <tr>
                            <th>Transx ID:</th>
                            @if (strtolower($order->payment_method) == 'stripe')
                                <th>{{ $order->payment->transaction_id }}</th>
                            @else

                            @endif

                        </tr>

                        <tr>
                            <th>Invoice:</th>
                            <th class="text-danger">{{ $order->invoice_no }}</th>
                        </tr>

                        <tr>
                            <th>Order Amonut:</th>
                            <th>{{ Currency::format($order->total) }}</th>
                        </tr>

                        <tr>
                            <th>Tax Amonut:</th>
                            <th>{{ Currency::format($order->tax) }}</th>
                        </tr>

                        <tr>
                            <th>Discount Amonut:</th>
                            <th>{{ Currency::format($order->discount) }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Amonut:</th>
                            <th>{{ Currency::format($order->shipping) }}</th>
                        </tr>

                        <tr>
                            <th>Total Amonut:</th>
                            <th>{{ Currency::format($order->total + $order->shipping - $order->discount + $order->tax ) }}</th>
                        </tr>

                        <tr>
                            <th>Order Status:</th>
                            <th>
                                @if ($order->status == 'pending')
                                    <span class="badge bg-warning" style="font-size: 15px;">{{ $order->status }}</span>
                                @elseif ($order->status == 'confirmed')
                                    <span class="badge bg-success" style="font-size: 15px;">{{ $order->status }}</span>
                                @elseif ($order->status == 'processing')
                                    <span class="badge bg-dark" style="font-size: 15px;">{{ $order->status }}</span>
                                @elseif ($order->status == 'delivering')
                                    <span class="badge bg-primary" style="font-size: 15px;">{{ $order->status }}</span>
                                @elseif ($order->status == 'completed')
                                    <span class="badge bg-info" style="font-size: 15px;">{{ $order->status }}</span>
                                @endif
                            </th>
                        </tr>


                        <tr>
                            <th> </th>
                            <th>
                                @if($order->status == 'pending')
                                    <form action="{{ route('admin.orders.confirmOrder',$order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-success" id="confirm" >Confirm Order</button>
                                    </form>

                                @elseif($order->status == 'confirmed')
                                <form action="{{ route('admin.orders.processorder',$order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-success" id="confirm" >Process Order</button>
                                </form>

                                @elseif($order->status == 'processing')
                                <form action="{{ route('admin.orders.deliveringOrder',$order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-success" id="confirm" >Shipping Order</button>
                                </form>

                                @elseif($order->status == 'delivering')
                                <form action="{{ route('admin.orders.completeOrder',$order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-success" id="confirm" >Order Completed</button>
                                </form>
                                @endif
                            </th>
                        </tr>

                    </table>

                </div>

            </div>
        </div>
    </div>






    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
        <div class="col">
            <div class="card">


                <div class="table-responsive">
                    <table class="table" style="font-weight: 600;"  >
                        <tbody>
                            <tr>
                                <td class="col-md-1">
                                    <label>Image </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Name </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Vendor Name </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Code  </label>
                                </td>
                                <td class="col-md-1">
                                    <label>Color </label>
                                </td>
                                <td class="col-md-1">
                                    <label>Size </label>
                                </td>
                                <td class="col-md-1">
                                    <label>Quantity </label>
                                </td>

                                <td class="col-md-3">
                                    <label> Price  </label>
                                </td>

                            </tr>


                            @foreach($order->items as $item)
                            <tr>
                                <td class="col-md-1">
                                    <label><img src="{{ asset($item->product->image_url) }}" style="width:50px; height:50px;" > </label>
                                </td>

                                <td class="col-md-2">
                                    <label>{{ $item->product->name}}</label>
                                </td>

                                @if($item->vendor_id == NULL)
                                    <td class="col-md-2">
                                        <label>Owner </label>
                                    </td>
                                @else
                                    <td class="col-md-2">
                                        <label>{{ $item->vendor->profile->first_name . " " .  $item->vendor->profile->last_name}} </label>
                                    </td>
                                @endif

                                <td class="col-md-2">
                                    <label>{{ $item->product->id }} </label>
                                </td>

                                @php
                                    if($item->options){
                                        $data = json_decode($item->options, true);
                                    }
                                @endphp

                                @if ($item->options && $data['color'])
                                    <td class="col-md-1">
                                        <label>{{ $data['color'] }}</label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>....</label>
                                    </td>
                                @endif

                                @if ($item->options && $data['size'])
                                    <td class="col-md-1">
                                        <label>{{ $data['size'] }}</label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>....</label>
                                    </td>
                                @endif


                                <td class="col-md-1">
                                    <label>{{ $item->quantity }} </label>
                                </td>

                                <td class="col-md-3">
                                    <label>{{ Currency::format($item->price) }} <br> Total = {{ Currency::format($item->price * $item->quantity) }}   </label>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>



            </div>
        </div>

    </div>

@endsection


@push("scripts")


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <x-flashtoaster />

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select the element with the class 'card'
            const cardElement = document.querySelector('.card');

            if (cardElement) {
                // Replace the class 'card' with 'cardss'
                cardElement.classList.replace('card', 'cardss');
            }
        });
    </script>

@endpush

@push("styles")
    <link href="{{asset("assetDashboard/assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


