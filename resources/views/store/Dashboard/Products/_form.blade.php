

<div class="row">
            <div class="col-lg-8">
                <div class="border border-3 p-4 rounded">


                    <div class="mb-3">
                        <x-form.label id="name" class="form-label">Product Name</x-form.label>
                        {{-- <x-form.input type="text" name="name" id="name" placeholder="Enter product title" :required="true" /> --}}
                        <x-form.input type="text" name="name" id="name" placeholder="Enter product title" :required="true" :value="$product->name"/>
                    </div>

                    <div class="mb-3">
                        <x-form.label id="tag-input" class="form-label">Product Tags</x-form.label>
                        <input type="text" name="tags" class="form-control visually-hidden" data-role="tagsinput" value="{{ old('tags',$tags ?? '') }}">
                        <x-form.validation-feedback name="product_tags" />
                        {{-- <x-form.input type="text" name="name" id="tag-input" :value="$product->tags"/> --}}
                    </div>

                    <div class="mb-3">
                        <x-form.label id="tag-product_colors" class="form-label">Product Colors</x-form.label>
                        <input type="text" name="product_colors" class="form-control visually-hidden" data-role="tagsinput" value="{{ old('product_colors',$colors ?? '') }}">
                        <x-form.validation-feedback name="product_colors" />
                        {{-- <x-form.input type="text" name="name" id="tag-input" :value="$product->tags"/> --}}
                    </div>

                    <div class="mb-3">
                        <x-form.label id="tag-product_sizes" class="form-label">Product Sizes</x-form.label>
                        <input type="text" name="product_sizes" class="form-control visually-hidden" data-role="tagsinput" value="{{ old('product_sizes',$sizes ?? '') }}">
                        <x-form.validation-feedback name="product_sizes" />
                        {{-- <x-form.input type="text" name="name" id="tag-input" :value="$product->tags"/> --}}
                    </div>

                    {{-- <div class="mb-3">
                        <label for="inputProductTitle" class="form-label">Product Size</label>
                        <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="Small,Midium,Large ">
                    </div>

                    <div class="mb-3">
                        <label for="inputProductTitle" class="form-label">Product Color</label>
                        <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="Red,Blue,Black">
                    </div> --}}



                    <div class="mb-3">
                        <x-form.label id="short_description" class="form-label">Short Description</x-form.label>
                        {{-- <x-form.textarea  name="short_description" id="short_description"  placeholder="Enter the Category Descripiton "/> --}}
                        <x-form.textarea  name="short_description" id="short_description" :value="$product->short_description" placeholder="Enter the Product Descripiton "/>
                    </div>

                    <div class="mb-3">
                        <x-form.label id="long_description" class="form-label">Short Description</x-form.label>
                        {{-- <x-form.textarea  name="long_description" id="long_description"  placeholder="Enter the Category Descripiton "/> --}}
                        <x-form.textarea  name="long_description" id="long_description" :value="$product->long_description" placeholder="Enter the Product Descripiton "/>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="inputProductDescription" class="form-label">Long Description</label>
                        <textarea id="" name="long_descp">Hello, World!</textarea>
                    </div> --}}

                    <input type="hidden" name="vendor_id" value="{{ auth('vendor')->user()->id }}">



                    <div class="mb-3">
                        <x-form.label id="image" class="form-label">Main Image</x-form.label>
                        <x-form.input name="image" type="file" id="image" onchange="mainImage(this)" class="mb-3"/>
                        <img src="{{ $product->image_url }}" id="mainimage" width="80" />
                    </div>



                    <div class="mb-3">

                            <x-form.label id="images" class="form-label">Gallary Images</x-form.label>
                            <input type="file" id="images" name="images[]" id="images" multiple class="form-control" accept="image/*">

                            <div class="row mt-3" id="preview_img">
                                {{-- @if ($gallary)
                                    @foreach ($gallary as $image )
                                        <img src="{{ asset("storage/" . $image->image) }}" class="thumb"  style="width: 200px;">
                                    @endforeach
                                @endif --}}
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <x-form.label id="regular_price" class="form-label">Product Price</x-form.label>
                            {{-- <x-form.input type="text" name="regular_price" id="regular_price" placeholder="00.00" :required="true" /> --}}
                            <x-form.input type="text" name="regular_price" id="regular_price" placeholder="00.00" :required="true" :value="$product->regular_price"/>
                        </div>


                        <div class="col-md-6">
                            <x-form.label id="discount_price" class="form-label">Discount Price</x-form.label>
                            {{-- <x-form.input type="text" name="discount_price" id="discount_price" placeholder="00.00" /> --}}
                            <x-form.input type="text" name="discount_price" id="discount_price" placeholder="00.00" :value="$product->discount_price"/>
                        </div>

                        <div class="col-md-6">
                            <x-form.label id="SKU " class="form-label">Product SKU</x-form.label>
                            {{-- <x-form.input type="text" name="SKU" id="SKU" :placeholder="00.00" /> --}}
                            <x-form.input type="text" name="SKU" id="SKU" :value="$product->SKU"/>
                        </div>


                        <div class="col-md-6">
                            <x-form.label id="quantitiy" class="form-label">Product quantitiy</x-form.label>
                            {{-- <x-form.input type="quantitiy" name="quantitiy" id="quantitiy" placeholder="00.00" /> --}}
                            <x-form.input type="quantitiy" name="quantitiy" id="quantitiy" placeholder="00.00" :value="$product->quantitiy"/>
                        </div>

                        <div class="col-12">
                            <x-form.label id="brand_id" class="form-label">Product Brand</x-form.label>
                            {{-- <select name="brand_id" class="form-select" id="brand_id ">
                                <option></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> --}}
                            <x-form.select name="brand_id" id="brand_id" :options="$brands" :selected="$product->brand_id"/>
                        </div>

                                                <div class="col-12">
                            <x-form.label id="catetgory_id" class="form-label">Product Category</x-form.label>
                            {{-- <select name="subcategory_id" class="form-select" id="catetgory_id">
                                <option></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> --}}
                            <x-form.select name="catetgory_id" id="catetgory_id" :options="$categories" :selected="$product->catetgory_id"/>
                        </div>

                        <div class="col-12">
                            <x-form.label id="status" class="form-label">Product Status</x-form.label>
                            {{-- <x-form.select name="status " id="status" :options="['active' => 'Active', 'draft'=>'Draft', 'inactive'=> 'Inactive']" /> --}}
                            <x-form.select name="status" id="status " :options="['active' => 'Active', 'draft'=>'Draft', 'inactive'=> 'Inactive']" :selected="$product->status"/>
                        </div>







                        <div class="col-12">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <!-- Hidden input to send '0' when unchecked -->
                                        <input type="hidden" name="featured" value="0">

                                        <!-- Checkbox to send '1' when checked -->
                                        <input class="form-check-input" name="featured" type="checkbox" value="1" id="featured"
                                            @checked(old('featured', $product->featured) == "1")>

                                        <label class="form-check-label" for="featured">Featured</label>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-check">
                                            <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                        </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-check">
                                            <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                        </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                    </div>
                                </div> --}}



                            </div> <!-- // end row  -->

                        </div>

                        <hr>


                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{ $type }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
