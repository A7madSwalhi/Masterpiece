@extends('user.layout.layout')

@section('title','Profile')

@section('content')
    <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-user" aria-hidden="true"></i> profile</h3>
        <div class="wsus__dashboard_profile">
            <div class="wsus__dash_pro_area">
                <h4>information</h4>
                <form action="{{ route('user.profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', $profile->first_name) }}">
                                        <x-form.validation-feedback name="first_name" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name', $profile->last_name) }}">
                                        <x-form.validation-feedback name="last_name" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-envelope-open"></i>
                                        <input type="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" disabled>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-phone-alt"></i>
                                        <input type="text" name="phone" placeholder="Phone" value="{{ old('phone', $profile->phone) }}">
                                        <x-form.validation-feedback name="phone" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-venus-mars"></i>
                                        <select name="gender" class="form-select">
                                            <option value="">Select Your Gender</option>
                                            <option value="male" @selected(old('gender', $profile->gender) == 'male')>Male</option>
                                            <option value="female" @selected(old('gender', $profile->gender) == 'female')>Female</option>
                                        </select>
                                        <x-form.validation-feedback name="gender" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-birthday-cake"></i>
                                        <input type="date" name="birthday" value="{{ old('birthday', $profile->birthday) }}">
                                        <x-form.validation-feedback name="birthday" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-globe"></i>
                                        <select name="country" class="select_2 select2-hidden-accessible">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $value => $text)
                                                <option value="{{ $value }}" @selected(old('country', $profile->country) == $value)>{{ $text }}</option>
                                            @endforeach
                                        </select>
                                        <x-form.validation-feedback name="country" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-city"></i>
                                        <input type="text" name="city" placeholder="City" value="{{ old('city', $profile->city) }}">
                                        <x-form.validation-feedback name="city" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-map"></i>
                                        <input type="text" name="state" placeholder="State" value="{{ old('state', $profile->state) }}">
                                        <x-form.validation-feedback name="state" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-home"></i>
                                        <input type="text" name="street_address" placeholder="Street Address" value="{{ old('street_address', $profile->street_address) }}">
                                        <x-form.validation-feedback name="street_address" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-envelope"></i>
                                        <input type="text" name="postal_code" placeholder="Postal Code" value="{{ old('postal_code', $profile->postal_code) }}">
                                        <x-form.validation-feedback name="postal_code" />
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-language"></i>
                                        <select name="locale" class="select_2 select2-hidden-accessible">
                                            <option value="">Select Your Language</option>
                                            @foreach ($locales as $value => $text)
                                                <option value="{{ $value }}" @selected(old('locale', $profile->locale) == $value)>{{ $text }}</option>
                                            @endforeach
                                        </select>
                                        <x-form.validation-feedback name="locale" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-md-6">
                            <div class="wsus__dash_pro_img">
                                <img src="{{ $profile->image_url }}" alt="img" class="img-fluid w-100" id="showImage">
                                <input type="file" name="image" id="image-form">
                                <x-form.validation-feedback name="image" />
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <button class="common_btn mb-4 mt-2" type="submit">Update</button>
                        </div>
                    </div>
                </form>


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