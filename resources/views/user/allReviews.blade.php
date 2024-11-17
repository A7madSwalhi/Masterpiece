@extends('user.layout.layout')

@section('title','User Reviews')

@section('content')
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-star" aria-hidden="true"></i> reviews</h3>
                <div class="wsus__dashboard_review">
                <div class="row">
                    @forelse ($reviews as $review )
                        <div class="col-xl-6">
                            <div class="wsus__dashboard_review_item">
                                <div class="wsus__dash_rev_img">
                                <img src="{{ $review->product->image_url }}" alt="product" class="img-fluid w-100">
                                </div>
                                <div class="wsus__dash_rev_text">

                                <h5>{{ $review->product->name }} <span>{{ $review->updated_at }}</span></h5>
                                <p class="wsus__dash_review">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas @if($i <= $review->rating) fa-star @endif" aria-hidden="true"></i>
                                    @endfor
                                </p>
                                <p>{{ $review->review }}</p>
                                <ul>
                                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"><i class="fal fa-edit" aria-hidden="true"></i> edit</a></li>

                                    <li>
                                        <form action="{{ route('user.profile.reviews.delete',$review->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"><i class="far fa-minus-circle" aria-hidden="true"></i> delete</button>
                                        </form>
                                    </li>

                                </ul>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-collapseOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                        <form action="{{ route('user.profile.reviews.update',$review->id) }}" method="POST">
                                            @csrf
                                            <div class="wsus__riv_edit_single">
                                            <i class="fas fa-star" aria-hidden="true"></i>
                                            <select class="form-select" name="rating" data-select2-id="select2-data-1-a6hw" tabindex="-1" aria-hidden="true">
                                                <option value="1" data-select2-id="select2-data-3-3xbp" @selected( 1 == $review->rating)>1</option>
                                                <option value="2" @selected( 2 == $review->rating)>2</option>
                                                <option value="3" @selected( 3 == $review->rating)>3</option>
                                                <option value="4" @selected( 4 == $review->rating)>4</option>
                                                <option value="5" @selected( 5 == $review->rating)>5</option>
                                            </select>
                                            </div>
                                            <div class="wsus__riv_edit_single text_area">
                                            <i class="far fa-edit" aria-hidden="true"></i>
                                                <textarea name="review" cols="3" rows="3" placeholder="Your Text">{{ $review->review }}</textarea>
                                            </div>
                                            <button type="submit" class="common_btn">submit</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-cl-12">
                            You Have No Reviews
                        </div>
                    @endforelse

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
