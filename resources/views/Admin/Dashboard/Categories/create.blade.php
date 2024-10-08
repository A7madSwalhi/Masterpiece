@extends("Admin.layout.dashboard")

@section("pagetitle","Add Category")

@section("title","Add Category")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"><a href="{{route("admin.categories.index")}}">All Category</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
@endsection


@section('content')
    <div class="card-body">
        <div class="p-4 border rounded">
            <form action="{{route("admin.categories.store")}}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                @include("Admin.Dashboard.Categories._form",['type' => "create"])
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