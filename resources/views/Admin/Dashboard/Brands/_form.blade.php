
            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="inputEnterYourName" class="col-form-label">Brand Name</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.input type="text" name="name" id="inputEnterYourName" placeholder="Enter Brand's Name" :required="true" :value="$brand->name"/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="status" class="col-form-label">Brand Status</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.select name="status"  id="status" :options="['active' => 'Active', 'draft'=>'Draft', 'inactive'=> 'Inactive']" :selected="$brand->status"/>
                </div>
            </div>

            <div class="row my-3">
                <div class="form-check d-flex flex-col align-items-center ms-5">
                    <input type="hidden" name="featured" value="0">
                    <input class="form-check-input" name="featured" type="checkbox" value="1" id="featured"
                            @checked(old('featured', $brand->featured) == "1")>
                    <x-form.label id="featured" class="col-form-label font-bold " style="margin-left: 200px;font-weight:bold;font-size:1rem">Featured</x-form.label>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="image-form" class="col-form-label">Image</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.input type="file" name="image" id="image-form"/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">

                </h6>
                <div class="col-sm-6">
                    <img id="showImage" src="{{$brand->image_url}}" width="110" alt="">
                </div>
            </div>
















            <div class="col-12">
                <button class="btn btn-primary" type="submit">{{$type}}</button>
            </div>
