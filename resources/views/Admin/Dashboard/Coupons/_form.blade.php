
            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="coupon_code" class="col-form-label">Coupon Name</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.input type="text" name="coupon_code" id="coupon_code" placeholder="Enter Coupon's Code" :required="true" :value="$coupon->coupon_code"/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="discount" class="col-form-label">Coupon Discount</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.input type="number" name="discount" id="discount" placeholder="Enter Coupon's Discount" :required="true" :value="$coupon->discount * 100 "/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="status" class="col-form-label">Coupon Status</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.select name="status"  id="status" :options="['1' => 'Active', '0'=> 'Inactive']" :selected="$coupon->status"/>
                </div>
            </div>

            <div class="row my-3">
                <h6 class="d-inline-flex align-items-center col-sm-2">
                    <x-form.label id="validity" class="col-form-label">Coupon Validity Date</x-form.label>
                </h6>
                <div class="col-sm-6">
                    <x-form.input type="date" name="validity" id="validity" placeholder="Enter Coupon's Code" :required="true" :value="$coupon->validity"/>
                </div>
            </div>




            <div class="col-12">
                <button class="btn btn-primary" type="submit">{{$type}}</button>
            </div>
