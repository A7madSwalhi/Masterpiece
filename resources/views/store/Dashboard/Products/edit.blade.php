@extends("store.layout.dashboard")

@section("pagetitle","Add Product")

@section("title","Add Product")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"><a href="{{route("vendor.products.index")}}">All Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
@endsection


@section('content')

<div class="card-body p-4">

    <h5 class="card-title">Add New Product</h5>
    <hr/>

    <form action="{{ route("vendor.products.update",$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include("vendor.Dashboard.Products._form",['type' => "Update"])


	</form>

</div>

    @if (count($gallary))
    <div class="card-body p-4">
        <h6 class="mb-0 text-uppercase">Update Multi Image</h6>
        <hr>
        <table class="table mb-0 table-striped">
            <thead>
                <tr>
                    <th scope="col">#Sl</th>
                    <th scope="col">Image</th>
                    <th scope="col">Change Image</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gallary as $img)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            {{-- Each image in the gallery has a unique ID --}}
                            <img id="gallaryImage_{{ $img->id }}" src="{{ asset("storage/" . $img->image) }}" style="width:70px; height:40px;">
                        </td>

                        <td>
                            <form method="POST" action="{{ route("vendor.products.feature.gallaryImage.update", $img->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                {{-- Each input also has a unique ID and calls the JS function --}}
                                <input type="file" class="form-group" name="image" id="gallaryInput_{{ $img->id }}" onchange="galImage(this, {{ $img->id }})">
                                <x-form.validation-feedback name="image" />
                                <button type="submit" class="btn btn-primary px-4">
                                    Update Image
                                </button>
                            </form>
                        </td>

                        <!-- Delete Form -->
                        <td>
                            <form action="{{ route("vendor.products.feature.gallaryImage.destroy", $img->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif




@endsection


@push('scripts')
<script type="text/javascript">
    function galImage(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Dynamically update the correct image preview using the unique image ID
                $('#gallaryImage_' + id).attr('src', e.target.result).width(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<x-flashtoaster />

@endpush




@push("styles")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="{{ asset('assetDashboard/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
