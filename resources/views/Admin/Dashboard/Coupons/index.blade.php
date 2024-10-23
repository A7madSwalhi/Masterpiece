@extends("Admin.layout.dashboard")

@section("pagetitle","All Coupons")

@section("title","All Coupons")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">All Coupons<span class="badge rounded-pill bg-danger ms-1">{{ count($coupons) }}</span></li>
@endsection


@section('addbutton')
    <a href="{{route("admin.coupons.create")}}" class="btn btn-success">Add Coupon</a>
@endsection



@section('content')
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">



                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
									<tr role="row">
                                        <th class=""  rowspan="1" colspan="1"  >SI</th>
                                        <th class=""  rowspan="1" colspan="1"  >Coupon Name</th>
                                        <th class=""  rowspan="1" colspan="1"  >Coupon Discount</th>
                                        <th class=""  rowspan="1" colspan="1"  >Coupon Validity</th>
                                        <th class=""  rowspan="1" colspan="1"  >Coupon Status</th>
                                        <th class=""  rowspan="1" colspan="1"  >Actios</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @forelse ( $coupons as $coupon)
                                <tr role="row" class="odd">
                                    <td>{{ $coupon->id  }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->discount *100 }}%</td>
                                    <td>{{$coupon->validity}}</td>
                                    <td>
                                        @if ($coupon->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @elseif ($coupon->status == 0)
                                            <span class="badge rounded-pill bg-danger ">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{route("admin.coupons.edit",$coupon->id)}}" class="btn btn-info ">
                                            <i class="bx bx-edit me-0"></i>
                                        </a>
                                        <form action="{{route("admin.coupons.destroy",$coupon->id)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bx bx-trash me-0"></i>
                                            </button>
                                        </form>
                                        {{-- <form action="{{ route('admin.brands.feature', $brand->id) }}" method="POST" style="display: none;" id="feature-form-{{ $brand->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="featured" value="{{ $brand->featured ? 0 : 1 }}">
                                        </form>

                                        @if ($brand->featured)
                                            <a href="#" class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('feature-form-{{ $brand->id }}').submit();">
                                                <i class="bx bx-star me-0"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-outline-warning" onclick="event.preventDefault(); document.getElementById('feature-form-{{ $brand->id }}').submit();">
                                                <i class="bx bx-star me-0"></i>
                                            </a>
                                        @endif --}}
                                    </td>
                                </tr>
                                @empty
                                    <td colspan="6" class="text-center">There is no brands</td>
                                @endforelse
                            </tbody>
							</table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        {{$coupons->withQueryString()->links()}}
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


