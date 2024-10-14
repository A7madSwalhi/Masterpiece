<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
    'first_name',
    'last_name',
    'birthday',
    'gender',
    'phone',
    'street_address',
    'city',
    'state',
    'postal_code',
    'country',
    'locale',
    'image',
    ];







    public function profileable()
    {
        return $this->morphTo();
    }


    public function getImageUrlAttribute()
    {
        if(!$this->image){
            return asset("assetDashboard/assets/images/profile.png");
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset("storage/" . $this->image);
    }

    public static function uploadImgae(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadedFile Object

        $path = $file->store('profile', [
            'disk' => 'public'
        ]);
        return $path;
    }

}
