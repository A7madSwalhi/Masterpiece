@extends("Admin.layout.dashboard")

@section("pagetitle","All Category")

@section("title","All Category")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">All Category</li>
@endsection


@section('addbutton')
    <a href="{{route("admin.categories.create")}}" class="btn btn-success">Add Category</a>
@endsection



@section('content')
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">

                    <div class="mt-3">
                        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                            <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
                            {{-- <select name="status" class="form-control mx-2">
                                <option value="">All</option>
                                <option value="active" @selected(request('status') == 'active')>Active</option>
                                <option value="archived" @selected(request('status') == 'inactive')>Inactive</option>
                            </select> --}}
                            <x-form.select name="status" :selected="request('status')" :options="['active' => 'Active' ,'inactive' => 'Inactive']"/>
                            <button class="btn btn-dark mx-2">Filter</button>
                        </form>
                    </div>

                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
									<tr role="row">
                                        <th class=""  rowspan="1" colspan="1"  style="width: 146.2px;">Image</th>
                                        <th class=""  rowspan="1" colspan="1"  style="width: 103.8px;">Name</th>
                                        <th class=""  rowspan="1" colspan="1"  style="width: 45.2px;">Parent Category</th>
                                        <th class=""  rowspan="1" colspan="1"  style="width: 228.2px;">Description</th>
                                        <th class=""  rowspan="1" colspan="1"  style="width: 96.2px;">Status</th>
                                        <th class=""  rowspan="1" colspan="1"  style="width: 77.2px;">Actios</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @forelse ( $categories as $category)
                                <tr role="row" class="odd">
                                    <td><img src="{{ $category->image_url}}" height="70"></td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->parent->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->status}}</td>
                                    <td>
                                        <a href="{{route("admin.categories.edit",$category->id)}}" class="btn btn-outline-info ">
                                            <i class="bx bx-edit me-0"></i>
                                        </a>
                                        <form action="{{route("admin.categories.destroy",$category->id)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bx bx-trash me-0"></i>
                                            </button>
                                        </form>
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
                        {{$categories->withQueryString()->links()}}
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


