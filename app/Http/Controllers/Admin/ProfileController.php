<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Locales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function edit($id)
    {

        $admin = Auth::guard('admin')->user();

        // dd($admin);

        // Try to retrieve the profile, or create an empty instance if not found
        $profile = $admin->profile;  // If profile exists, it will be retrieved

        if (!$profile) {
            // If no profile exists, create a new empty profile instance (unsaved)
            $profile = new Profile([
                'first_name' => '',
                'last_name' => '',
                'birthday' => null,
                'gender' => null,
                'phone' => '',
                'street_address' => '',
                'city' => '',
                'state' => '',
                'postal_code' => '',
                'country' => '',
                'locale' => 'en',

            ]);


            $profile->profileable()->associate($admin);
        }

        $countries = Countries::getNames();
        $locales = Locales::getNames();


        return view('Admin.profile', compact('profile','countries','locales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Auth::guard('admin')->user();

        // Validate the input data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'phone' => 'nullable|string|max:20',
            'street_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'locale' => 'nullable|string|max:5',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);


        $profile = $admin->profile;


        if ($profile) {

            $old_image = $profile->image;
            $data = $request->except('image');
            $new_image = Profile::uploadImgae($request);

            if ($new_image) {
                $data['image'] = $new_image;
            }

            $profile->update($data);

            if ($old_image && $new_image) {
                Storage::disk('public')->delete($old_image);
            }

            if ($old_image && $new_image) {
                Storage::disk('public')->delete($old_image);
            }

        } else {
            $data = $request->except('image');
            $new_image = Profile::uploadImgae($request);

            if ($new_image) {
                $data['image'] = $new_image;
            }

            $profile = new Profile($data);
            $profile->profileable()->associate($admin); // Associate the profile with the admin
            $profile->save();




        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}