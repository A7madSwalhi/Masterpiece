@extends("Admin.layout.dashboard")

@section("pagetitle","All Products")

@section("title","All Products")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">All Products <span class="badge rounded-pill bg-danger">{{ count($products) }}</span> </li>
@endsection


@section('addbutton')
    <a href="{{route("admin.products.create")}}" class="btn btn-success">Add Products</a>
@endsection



@section('content')
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">

                    <div class="mt-3">
                        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                            <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
                            <x-form.select name="status" first="Status" class="mx-2" :selected="request('status')" :options="['active' => 'Active' ,'inactive' => 'Inactive','draft' => 'Draft']"/>
                            <x-form.select name="discount_price" first="Product Type" :selected="request('discount_price')" :options="['without' =>'Not Discounted Product'  , 'with' => 'Discounted Product']"/>
                            <button class="btn btn-dark mx-2">Filter</button>
                        </form>
                    </div>

                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
									<tr role="row">
                                        <th class="" >SI</th>
                                        <th class="" >Image</th>
                                        <th class="" >Product</th>
                                        <th class="" >Price</th>
                                        <th class="" >QTY</th>
                                        <th class="" >Discount</th>
                                        <th class="" >Status</th>
                                        <th class="" >Actios</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @forelse ( $products as $product)
                                <tr role="row" class="odd">

                                    <td>{{ $product->id +1 }}</td>
                                    <td><img src="{{ $product->image_url}}" height="40"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{Currency::format($product->regular_price)}}</td>
                                    <td>{{$product->quantitiy}}</td>
                                    <td>
                                        @if ($product->discount_percentage == 'No Discount')
                                            <span class="badge rounded-pill bg-info">{{ $product->discount_percentage }}</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger ">{{ $product->discount_percentage }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->status == 'active')
                                            <span class="badge rounded-pill bg-success">{{$product->status}}</span>
                                        @elseif ($product->status == 'inactive')
                                            <span class="badge rounded-pill bg-danger ">{{$product->status}}</span>
                                        @elseif ($product->status == 'draft')
                                            <span class="badge rounded-pill bg-warning ">{{$product->status}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{route("admin.products.show",$product->id)}}" class="btn btn-primary ">
                                                <i class="bx bx-show me-0"></i>
                                        </a>
                                        <a href="{{route("admin.products.edit",$product->id)}}" class="btn btn-info ">
                                            <i class="bx bx-edit me-0"></i>
                                        </a>
                                        <form action="{{route("admin.products.destroy",$product->id)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bx bx-trash me-0"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.products.feature', $product->id) }}" method="POST" style="display: none;" id="feature-form-{{ $product->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="featured" value="{{ $product->featured ? 0 : 1 }}">
                                        </form>

                                        @if ($product->featured)
                                            <a href="#" class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('feature-form-{{ $product->id }}').submit();">
                                                <i class="bx bx-star me-0"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-outline-warning" onclick="event.preventDefault(); document.getElementById('feature-form-{{ $product->id }}').submit();">
                                                <i class="bx bx-star me-0"></i>
                                            </a>
                                        @endif
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
                        {{$products->withQueryString()->links()}}
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


