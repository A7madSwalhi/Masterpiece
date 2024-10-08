
            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="inputEnterYourName" class="col-form-label">Category Name</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.input type="text" name="name" id="inputEnterYourName" placeholder="Enter Your Name" :required="true" :value="$category->name"/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="parent_id" class="col-form-label">Category Parent</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.select name="parent_id" id="parent_id" :options="$parents" :selected="$category->id"/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="Description-form" class="col-form-label">Description</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.textarea  name="description" id="Description-form" :value="$category->description" placeholder="Enter the Category Descripiton "/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="inputEnterYourName" class="col-form-label">Status</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.radio type="text" name="status" :checked="$category->status" :required="true" :options="['active' => 'Active','inactive'=>'Inactive']"/>
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
                    <img id="showImage" src="{{$category->image_url}}" width="110" alt="">
                </div>
            </div>







            <div class="col-12">
                <button class="btn btn-primary" type="submit">{{$type}}</button>
            </div>
