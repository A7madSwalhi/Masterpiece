<?php

namespace App\Http\Controllers\user;

use App\Models\Profile;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Locales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class dashboardController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    public function profile($id){

        $user = Auth::guard('web')->user();

        $profile = $user->profile;

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


            $profile->profileable()->associate($user);
        }

        $countries = Countries::getNames();
        $locales = Locales::getNames();

        return view('user.myprofile',compact('profile','countries','locales'));
    }

    public function updateProfile(Request $request,$id){

        $user = Auth::guard('web')->user();
        try{
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
        }catch (ValidationException $e){
            dd($e->errors());
        }
        // Validate the input data


        // dd($validatedData);




        $profile = $user->profile;


        if ($profile->first_name) {

            $old_image = $profile->image;
            $data = $request->except('image');
            // dd($profile);
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
            $profile->profileable()->associate($user); // Associate the profile with the admin
            $profile->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
