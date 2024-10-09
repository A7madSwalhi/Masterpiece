<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VendorLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VendorLoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('store.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(VendorLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('vendor.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('vendor')->logout();

        session()->forget('vendor_session');
        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('vendor.login'));
    }
}
