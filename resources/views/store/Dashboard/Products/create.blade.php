@extends("store.layout.dashboard")

@section("pagetitle","Add Product")

@section("title","Add Product")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"><a href="{{route("vendor.products.index")}}">All Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
@endsection


@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card-body p-4">

    <h5 class="card-title">Add New Product</h5>
    <hr/>

    <form action="{{route("vendor.products.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include("store.Dashboard.Products._form",['type' => "Create"])
	</form>

</div>



@endsection


@push('scripts')

<script type="text/javascript">
	function mainImage(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainimage').attr('src',e.target.result).width(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

<script>

    $(document).ready(function(){
        $('#images').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(200); //create image element
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

</script>

<script src="{{ asset('assetDashboard/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
@endpush




@push("styles")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="{{ asset('assetDashboard/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

@endpush
