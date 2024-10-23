@extends("Admin.layout.dashboard")

@section("pagetitle","Add Coupon")

@section("title","Add Coupon")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"><a href="{{route("admin.coupons.index")}}">All Coupons</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
@endsection


@section('content')
    <div class="card-body">
        <div class="p-4 border rounded">
            <form action="{{route("admin.coupons.store")}}" method="POST" class="row g-3">
                @csrf
                @include("Admin.Dashboard.coupons._form",['type' => "create"])
            </form>
    </div>
</div>

@endsection



@push("styles")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush
