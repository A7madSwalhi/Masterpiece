@extends('user.layout.layout')

@section('title','User Orders')

@section('content')
        <div class="dashboard_content">
        <h3><i class="fas fa-list-ul" aria-hidden="true"></i> orders</h3>
        <div class="wsus__dashboard_order">
            <div class="table-responsive">
                <table class="table m-auto">
                    <thead>
                        <tr>
                            <th class="package">Invoice No</th>
                            <th class="tr_id">Order Date</th>
                            <th class="e_date">Payment Method</th>
                            <th class="price">Price</th>
                            <th class="method">Status</th>
                            <th class="method">status</th>
                        </tr>
                    </thead>



                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="package">{{ $order->invoice_no  }}</td>
                                <td class="tr_id">{{ $order->created_at }}</td>
                                <td class="e_date">
                                    @if ( $order->payment_method == 'cod')
                                        {{ "Cash On Delevery" }}
                                    @else
                                        {{ $order->payment_method }}
                                    @endif
                                </td>
                                <td class="price">{{ Currency::format( $order->total + $order->tax + $order->shipping - $order->discount ) }}</td>
                                <td class="method">
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

                                    @if ($order->status == 'refunded')
                                        <span class="badge rounded-pill bg-danger ">Return</span>
                                    @endif
                                </td>

                                <td class="method">
                                    <a  class="btn btn-sm btn-outline-info me-2" href="{{ route('user.orders.show',$order->id) }}">view</a>

                                    @if ($order->status == 'pending' || $order->status == 'confirmed' || $order->status == 'processing')
                                    <form action="{{ route('user.orders.cancel',$order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"  class="btn btn-sm btn-outline-danger" href="dsahboard_order_invoice.html">Cancel</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>No Order Exist</tr>
                        @endforelse

                    </tbody>

                </table>
            </div>


            <div id="pagination">
                {{ $orders->links('pagination.custome') }}
            </div>
        </div>
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
