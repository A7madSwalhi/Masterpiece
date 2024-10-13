@extends("Admin.layout.dashboard")

@section("pagetitle","Add Brand")

@section("title","Add Brand")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"><a href="{{route("admin.brands.index")}}">All Brand</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
@endsection


@section('content')
    <div class="card-body">
        <div class="p-4 border rounded">
            <form action="{{route("admin.brands.store")}}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                @include("Admin.Dashboard.brands._form",['type' => "create"])
            </form>
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

@endpush

@push("styles")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush
