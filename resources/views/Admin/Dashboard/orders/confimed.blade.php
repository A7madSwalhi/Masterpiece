@extends("Admin.layout.dashboard")

@section("pagetitle","All Confirmed Orders")

@section("title","All Confirmed Orders")

@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active" aria-current="page">All Confirmed Orders<span class="badge rounded-pill bg-danger ms-1">{{ count($orders) }}</span> </li>
@endsection






@section('content')
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">

                    <div class="mt-3">
                        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                            <x-form.input name="invoice_no" placeholder="Invoice No." class="mx-2" :value="request('invoice_no')" />
                            <x-form.select name="payment_method" first="Payment Type" :selected="request('payment_method')" :options="['cod' =>'Cash On Delivery'  , 'stripe' => 'Stripe']"/>
                            <button class="btn btn-dark mx-2">Filter</button>
                        </form>
                    </div>

                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
									<tr role="row">
                                        <th class="" >SI</th>
                                        <th class="" >Date</th>
                                        <th class="" >Invoice</th>
                                        <th class="" >Amount</th>
                                        <th class="" >Payment</th>
                                        <th class="" >State</th>
                                        <th class="" >Action</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @forelse ( $orders as $order)
                                <tr role="row" class="odd">

                                    <td>{{ $order->id +1 }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{$order->invoice_no}}</td>
                                    <td>{{Currency::format($order->total)}}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge rounded-pill bg-warning">{{$order->status}}</span>
                                        @elseif ($order->status == 'confirmed')
                                            <span class="badge rounded-pill bg-success ">{{$order->status}}</span>
                                        @elseif ($order->status == 'processing')
                                            <span class="badge rounded-pill bg-dark ">{{$order->status}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show',$order->id) }}" class="btn btn-primary ">
                                                <i class="bx bx-show me-0"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <td colspan="6" class="text-center">There is no Categories</td>
                                @endforelse
                            </tbody>
							</table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        {{$orders->withQueryString()->links()}}
                    </div>
                </div>
        </div>
    </div>

@endsection


@push("scripts")
    <script src="{{asset( "assetDashboard/assets/plugins/datatable/js/jquery.dataTables.min.js")}}" ></script>
    <script src="{{asset( "assetDashboard/assets/plugins/datatable/js/dataTables.bootstrap5.min.js")}}" ></script>
    <script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <x-flashtoaster />

@endpush

@push("styles")
    <link href="{{asset("assetDashboard/assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush


