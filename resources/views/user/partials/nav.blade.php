@php
    $isExist = App\Models\Vendor::where('email','=',value: auth()->user()->email)->first();
    // dd($isExist)
@endphp



<ul class="dashboard_link">
    <li><a class="{{ Request::routeIs('user.dashboard') ? 'active' : '' }}"  href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
    <li><a class="{{ Request::routeIs('user.profile.orders') || Request::routeIs('user.orders.show') ? 'active' : '' }}" href="{{ route('user.profile.orders') }}"><i class="fas fa-list-ul"></i> Orders</a></li>
    <li><a class="{{ Request::routeIs('user.profile') ? 'active' : '' }}"  href="{{ route('user.profile',Auth::guard('web')->user()->id) }}"><i class="far fa-user"></i> My Profile</a></li>
    <li><a class="{{ Request::routeIs('user.profile.reviews') ? 'active' : '' }}" href="{{ route('user.profile.reviews') }}"><i class="far fa-star"></i> Reviews</a></li>

    @if ($isExist)
        <li>
            <form action="{{ route('switch.to.vendor',auth()->user()->email) }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="far fa-gift-card"></i>  Vendor Account
                </button>
            </form>
        </li>
    @else
        <li><a class="{{ Request::routeIs('user.profile.bevendor.index') ? 'active' : '' }}" href="{{ route('user.profile.bevendor.index') }}"><i class="fal fa-gift-card"></i>Become Vendor</a></li>
    @endif


    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <i class="far fa-sign-out-alt"></i> Log out
            </button>
        </form>
    </li>
</ul>
