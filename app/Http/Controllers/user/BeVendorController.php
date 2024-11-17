<?php

namespace App\Http\Controllers\user;

use App\Models\Vendor;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Locales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Intl\Countries;

class BeVendorController extends Controller
{
    public function index(){

        $countries = Countries::getNames();
        $locales = Locales::getNames();

        return view('user.beVendor',compact('countries','locales'));
    }

    public function create(Request $request){
        // Validate request inputs
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string|max:20',
            'street_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'description' => 'string|max:500',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'locale' => 'nullable|string|max:5',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $logoImagePath = null;
        $coverImagePath = null;

        if ($request->hasFile('image')) {
            $logoImagePath = Profile::uploadImgae($request);
        }

        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('cover_images', [
            'disk' => 'public'
            ]);
        }

        // Create vendor
        $vendor = Vendor::create([
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'shop_name' => $request->post('shop_name'),
            'slug'=>Str::slug($request->post('shop_name')),
            'email' => auth()->user()->email,
            'password' => Hash::make($request->input('password')),
            'description' => $request->input('description'),
            'logo_image' => $logoImagePath,
            'status' => 'inactive',
            'cover_image' => $coverImagePath,
        ]);

        // Create profile associated with the vendor
        $profile = new Profile([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'street_address' => $request->input('street_address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'locale' => $request->input('locale'),
            'image' => $logoImagePath,
        ]);

        // Save the profile with morphable relationship
        $vendor->profile()->save($profile);

        // Redirect or return a response
        return redirect()->route('user.dashboard')->with('success', 'Vendor account and profile created successfully.');
    }

    public function switchToVendorAccount(Request $request, $email)
    {
        // Log out from the current user (web guard)
        Auth::guard('web')->logout();

        // Find the vendor to log in by email
        $vendor = Vendor::where('email', $email)->first();

        if (!$vendor) {
            return redirect()->back()->with('error', 'Vendor account not found.');
        }

        // Log in to the vendor guard
        Auth::guard('vendor')->login($vendor);

        // Redirect to vendor dashboard or any desired page
        return redirect()->route('vendor.dashboard')->with('success', 'Successfully switched to vendor account.');
    }
}
