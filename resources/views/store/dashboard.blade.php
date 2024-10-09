@extends("store.layout.dashboard")

@section('pagetitle',"test title")

@section('title',"Products")

@section('Test Heading')

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Products</li>

@endsection

@section('content')

    <h1>Hello Iam {{ Auth::guard('vendor')->user()->name }}</h1>

    <form method="POST" action="{{route("vendor.logout")}}" >
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>

@endsection

