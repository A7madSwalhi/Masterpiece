<x-front-layout :title="'Vendors'">

    <x:$breadcrumb>
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>Vendors</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="#">Vendors</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x:$breadcrumb>

    <!--============================
        VENDORS START
    ==============================-->

    <section id="wsus__product_page" class="wsus__vendors">
        <div class="container">
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-xl-12 d-none d-lg-block">

                        </div>
                        @forelse ( $vendors as $vendor)
                            <div class="col-xl-6 col-md-6">
                                <div class="wsus__vendor_single">
                                    <img src="{{ $vendor->cover_image_url }}" alt="vendor" class="img-fluid w-100">
                                    <div class="wsus__vendor_text">
                                        <div class="wsus__vendor_text_center">
                                            <h4>{{ $vendor->shop_name }}</h4>
                                            <a href="callto:{{ $vendor->profile->phone ?? ' ' }}"><i class="far fa-phone-alt" aria-hidden="true"></i>
                                                {{ $vendor->profile->phone ?? ' ' }}</a>
                                            <a href="mailto:{{ $vendor->email ?? ' ' }}"><i class="fal fa-envelope" aria-hidden="true"></i>
                                                {{ $vendor->email ?? ' ' }}</a>
                                            <a href="{{ route('products.index') . '?vendor_id=' . $vendor->id}}" class="common_btn">visit store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center mt-5">
                                <div class="card">
                                        <div class="card-body">
                                            <h2>No Stores Found!</h2>
                                        </div>
                                    </div>
                            </div>
                        @endforelse

                    </div>
                    <div class="col-xl-12">
                        <section id="pagination">
                            <div class="mt-5">

                                    {{ $vendors->links('pagination.custome') }}

                            </div>
                        </section>
                    </div>
            </div>
        </div>
    </section>


    <!--============================
        VENDORS END
    ==============================-->

    @push('scripts')
        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                });
            </script>
        @endif
    @endpush

</x-front-layout>
