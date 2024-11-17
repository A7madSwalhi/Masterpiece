<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $guard = 'vendor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_name',
        'slug',
        'cover_image',
        'status',
        'logo_image',
        'description',
        'cover_image',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function products()
    {
        return $this->hasMany(Product::class,'vendor_id','id');
    }

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable')->withDefault();
    }


    public function getCoverImageUrlAttribute()
    {
        if(!$this->cover_image){
            return asset("assetDashboard/assets/images/default_cover.png");
        }
        if (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }
        return asset("storage/" . $this->cover_image);
    }

}
